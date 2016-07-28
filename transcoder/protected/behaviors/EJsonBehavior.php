<?php

class EJsonBehavior extends CBehavior {
    private $owner;
    private $relations;

    public function getArrayRec($array) {
        $result = array();
        foreach ($array as $arrayPart) {
            if (is_array($arrayPart)) {
                $result[] = $this->getArrayRec($arrayPart);
            }
            else
            if (is_object($arrayPart))
                $result[] = $this->toJSONObj($arrayPart);
            else
                $result[] = $arrayPart;
        }
        return $result;
    }

    public function toJSONObj($object) {
        $attributes = $object->getAttributes();
        $this->relations = $this->getSubRelated($object);
        return array('attributes' => $attributes, 'related' => $this->relations);
        ;
    }

    public function toJSON() {
        $this->owner = $this->getOwner();
        $result = array();
        if (is_subclass_of($this->owner, 'CActiveRecord')) {
            $result = $this->toJSONObj($this->owner);
        }
        elseif (isset($this->owner->arrayObj) && is_array($this->owner->arrayObj)) {
            $result = $this->getArrayRec($this->owner->arrayObj);
        }
        if (count($result) > 0)
            return CJSON::encode($result);
        return false;
    }

    private function getSubRelated($relatedObj) {
        $related = array();
        $obj = null;
        $md = $relatedObj->getMetaData();
        foreach ($md->relations as $name => $relation) {
            $obj = $relatedObj->getRelated($name);
            if (is_array($obj) && count($obj) > 1)
                foreach ($obj as $objPart) {
                    $related[$name][$objPart->getPrimaryKey()]['attributes'] = $objPart instanceof CActiveRecord ? $objPart->getAttributes() : $objPart;
                    $related[$name][$objPart->getPrimaryKey()]['related'] = $objPart instanceof CActiveRecord ? $this->getSubRelated($objPart) : $objPart;
                }
            elseif ($obj instanceof CActiveRecord) {
                $related[$name]['attributes'] = $obj->getAttributes();
                $related[$name]['related'] = $this->getSubRelated($obj);
            }
            elseif (is_array($obj) && count($obj) == 1) {
                $related[$name]['attributes'] = $obj[0] instanceof CActiveRecord ? $obj[0]->getAttributes() : $obj[0];
                $related[$name]['related'] = $obj[0] instanceof CActiveRecord ? $this->getSubRelated($obj[0]) : $obj[0];
            }
        }

        return $related;
    }

}