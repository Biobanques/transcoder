<?php

class CodeForm extends CFormModel
{
    public $codeOblig;
    public $codeFacult;
    public $codeObligLength;
    public $codeFacultLength;

    /**     * @codeCoverageIgnore     */
    public function beforeValidate() {
        $this->codeOblig = trim($this->codeOblig);
        $this->codeFacult = trim($this->codeFacult);
        $this->codeObligLength = strlen($this->codeOblig);
        $this->codeFacultLength = strlen($this->codeFacult);
        return true;
    }

    /**     * @codeCoverageIgnore     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('codeObligLength', 'in', 'range' => array(0, 2, 4, 6, 8), 'message' => "Le code obligatoire est mal formé."),
            array('codeFacultLength', 'in', 'range' => array(0, 7), 'message' => "Le code facultatif est mal formé."),
            array('codeOblig,codeFacult', 'safe', 'on' => 'search')
        );
    }

    /**     * @codeCoverageIgnore     */
    public function relations() {
        return array(
            'codeOblig' => 'code obligatoire',
            'codeFacult' => 'code facultatif',
        );
    }

    public function searchFromForm() {
        $code = $this->codeOblig;
        $codeFac = $this->codeFacult;
        return $this->searchWithCode($code, $codeFac);
    }

    /**
     * return search after parsing codeOblig and codeAdmin
     */
    public function searchWithCode($code, $codeFac) {
        $result = array();
        $modPrel = null;
        $typeTech = null;
        $organe = null;
        $lesion = null;
        $topoComp = null;
        $tumPrim = null;


        /**
         * parse du code obligatoire en fonction du nombre de caracteres presents
         * puis recherche de corresondance et renvoi des resultats
         */
        if ($code != null && strlen($code) == 8) {
            $modPrel = "$code[0]";
            $typeTech = "$code[1]";
            $organe = "$code[2]$code[3]";
            $lesion = "$code[4]$code[5]$code[6]$code[7]";
        } elseif ($code != null && strlen($code) == 2) {
            $organe = "$code[0]$code[1]";
        } elseif ($code != null && strlen($code) == 4) {

            $lesion = "$code[0]$code[1]$code[2]$code[3]";
        } elseif ($code != null && strlen($code) == 6) {

            $organe = "$code[0]$code[1]";
            $lesion = "$code[2]$code[3]$code[4]$code[5]";
        }

        $result['modPrel'] = array('Mode de prélèvement', $this->searchWithPartialCode($modPrel, 1));
        $result['typeTech'] = array('Type de technique utilisée', $this->searchWithPartialCode($typeTech, 2));
        $result['organe'] = array('organe', $this->searchWithPartialCode($organe));
        $result['lesion'] = array('lesion', $this->searchWithPartialCode($lesion));
        if (!empty($lesion) && !empty($organe))
            $result['codeLie'] = array('code lié', $this->searchWithPartialCode($organe . $lesion));
        else
            $result['codeLie'] = null;
        /**
         * parse du code facultatif
         * puis recherche de corresondance et renvoi des resultats
         */
        if ($codeFac != null && !empty($codeFac)) {
            if (isset($codeFac[2]) && $codeFac[2] != "*" && isset($codeFac[3]) && $codeFac[3] != "*")
                $topoComp = "$codeFac[2]$codeFac[3]";
            if (isset($codeFac[5]) && $codeFac[5] != "*" && isset($codeFac[6]) && $codeFac[6] != "*")
                $tumPrim = "$codeFac[5]$codeFac[6]";
        }
        $result['topoComp'] = array('topographie complémentaire', $this->searchWithPartialCode($organe . '!' . $topoComp));
        $result['tumPrim'] = array('tumeur primitive', $this->searchWithPartialCode($tumPrim));

        return $result;
    }

    /**
     * Recherche ADICAP + elements associés à partir de l'extrait de code fourni
     * @param type $code
     * @return type
     */
    public function searchWithPartialCode($code, $dictionnary = null) {
        $critCode = new CDbCriteria;
        $critCode->addCondition("t.CODE='$code'");
        if ($dictionnary != null) {
            $critCode->addCondition("t.ADICAP_GROUPE_ID=$dictionnary");
        }

        $critCode->with = array('aDICAPPARENT', 'aDICAPGROUPE', 'cIMMASTERs', 'cIMOMORPHOs', 'cIMMASTERs.cIMLIBELLEs', 'aDICAPGROUPE.gROUPEPARENT');
        $result = ADICAP::model()->find($critCode);

        if ($result == null) {
            $result = $this->searchApproch($code);
        }
        return $result;
    }

    /**
     * effectue une recherche sur un code approximatif (1 caractère de différence)
     * sur les codes à 2 ou 4 caractères
     * @param type $code
     * @return type
     */
    public function searchApproch($code) {
        $result = null;
        $critCodeApp = new CDbCriteria;
        if (strlen($code) == 2) {
            $critCodeApp->addCondition('CODE REGEXP "[[:<:]]' . $code[0] . '[0-9 a-z A-Z]{1}[[:>:]]" and CODE NOT LIKE "%!%"', 'OR');
            $critCodeApp->addCondition('CODE REGEXP "[[:<:]][0-9 a-z A-Z]{1}' . $code[1] . '[[:>:]]" and CODE NOT LIKE "%!%"', 'OR');
            $result = ADICAP::model()->findAll($critCodeApp);
        } elseif (strlen($code) == 4) {
            $critCodeApp->addCondition('CODE REGEXP "[[:<:]]' . $code[0] . $code[1] . $code[2] . '[0-9 a-z A-Z]{1}[[:>:]]" and CODE NOT LIKE "%!%"', 'OR');
            $critCodeApp->addCondition('CODE REGEXP "[[:<:]]' . $code[0] . $code[1] . '[0-9 a-z A-Z]{1}' . $code[3] . '[[:>:]]" and CODE NOT LIKE "%!%"', 'OR');
            $critCodeApp->addCondition('CODE REGEXP "[[:<:]]' . $code[0] . '[0-9 a-z A-Z]{1}' . $code[2] . $code[3] . '[[:>:]]" and CODE NOT LIKE "%!%"', 'OR');
            $critCodeApp->addCondition('CODE REGEXP "[[:<:]][0-9 a-z A-Z]{1}' . $code[1] . $code[2] . $code[3] . '[[:>:]]" and CODE NOT LIKE "%!%"', 'OR');

            $result = ADICAP::model()->findAll($critCodeApp);
        }
        return $result;
    }

}