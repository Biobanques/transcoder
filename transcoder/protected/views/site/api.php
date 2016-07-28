
<h1>API pour développeurs</h1>
<div>
    L'outil Transcoder a été développé pour que vous puissiez l'intégrer dans vos outils
    existants et ainsi traduire automatiquement certains codes disponibles pour faciliter le dialogue
    avec vos collaborateurs utilisant la codification CIM-O-3.
    Cette interface est gratuite et mise à disposition de tous.
    Si vous rencontrez des problèmes ou souhaitez émettre diverses remarques, veuillez utiliser le formulaire de contact disponible dans le site.
</div>
<div>
    <div><b>Principe de fonctionnement de l'API : </b></div>
    <div>L'API disponible suite une architecture de type REST. L'API peut être appelé via HTTP avec une requête GET.
        Le résultat de l'appel sera un ensemble de données au format JSON.
        Ces choix technologies ont été effectués pour simplifier les appels et alléger au maximum les flux de données.
        Si vous avez des suggestions, vous pouvez les soumettre via le formulaire de contact du site.
    </div>
    <div>
        <div><b>Exemple d'appel de l'API</b></div>
        <div>
            L'utilisateur souhaite traduire automatiquement le code <i>BHFF7730</i>.<br>
            Il va donc devoir appeler le service via HTTP  :
            <div>
                <pre><code>http://transcoder.ebiobanques.fr/index.php?r=adicap/wsSearch&code=BHFF7730 </code></pre>
            </div>

            Le résultat ainsi obtenu sera  un résultat au format JSON :
            <div style="height:300px;overflow:auto">
                <pre><code>
["Mode de pr\u00e9l\u00e8vement",
{
    "attributes": {
        "MORPHO": null,
        "ADICAP_ID": "2",
        "CODE": "B",
        "LIBELLE": "BIOPSIE CHIRURGICALE",
        "ADICAP_GROUPE_ID": "1",
        "ADICAP_PARENT_ID": null
    },
    "related": {
        "aDICAPGROUPE": {
            "attributes": {
                "GROUPE_PARENT_ID": null,
                "ADICAP_GROUPE_ID": "1",
                "NOM": "D1"
            },
            "related": []
        }
    }
}], ["Type de technique utilis\u00e9e",
{
    "attributes": {
        "MORPHO": null,
        "ADICAP_ID": "7",
        "CODE": "H",
        "LIBELLE": "HISTOPONCTION GUIDEE PAR IMAGERIE",
        "ADICAP_GROUPE_ID": "1",
        "ADICAP_PARENT_ID": null
    },
    "related": {
        "aDICAPGROUPE": {
            "attributes": {
                "GROUPE_PARENT_ID": null,
                "ADICAP_GROUPE_ID": "1",
                "NOM": "D1"
            },
            "related": []
        }
    }
}], ["organe",
{
    "attributes": {
        "MORPHO": null,
        "ADICAP_ID": "89",
        "CODE": "FF",
        "LIBELLE": "FOIE",
        "ADICAP_GROUPE_ID": "3",
        "ADICAP_PARENT_ID": "87"
    },
    "related": {
        "aDICAPGROUPE": {
            "attributes": {
                "GROUPE_PARENT_ID": null,
                "ADICAP_GROUPE_ID": "3",
                "NOM": "D3"
            },
            "related": []
        },
        "aDICAPPARENT": {
            "attributes": {
                "MORPHO": null,
                "ADICAP_ID": "87",
                "CODE": "FZ",
                "LIBELLE": "FOIE- VOIES BILIAIRES- PANCREAS SAI",
                "ADICAP_GROUPE_ID": "3",
                "ADICAP_PARENT_ID": null
            },
            "related": {
                "aDICAPGROUPE": {
                    "attributes": {
                        "GROUPE_PARENT_ID": null,
                        "ADICAP_GROUPE_ID": "3",
                        "NOM": "D3"
                    },
                    "related": []
                },
                "cIMMASTERs": {
                    "1084": {
                        "attributes": {
                            "SID": "1084",
                            "sort": "C26.8",
                            "abbrev": "C268",
                            "LEVEL_": "5",
                            "type": "S",
                            "id1": "932",
                            "id2": "933",
                            "id3": "1013",
                            "id4": "1081",
                            "id5": "1084",
                            "id6": "0",
                            "id7": "0",
                            "valid": "1",
                            "date": null,
                            "author": "start",
                            "comment": " ",
                            "CIMO3": "1",
                            "code": "C26.8",
                            "LIBELLE": "l\u00e9sion \u00e0 localisations contigu\u00ebs de l'appareil digestif"
                        },
                        "related": {
                            "cIMLIBELLEs": {
                                "\u0000CActiveRecord\u0000_new": {
                                    "attributes": {
                                        "LID": "29475",
                                        "SID": "1084",
                                        "source": "E",
                                        "valid": "1",
                                        "libelle": "jonction cardio-oesophagienne",
                                        "FR_OMS": "jonction cardio-oesophagienne",
                                        "EN_OMS": "cardio-oesophageal junction",
                                        "GE_DIMDI": "Speiser\u00f6hren-Magen-\u00dcbergang",
                                        "GE_AUTO": "Speiser\u00f6hren-Magen-\u00dcbergang",
                                        "FR_CHRONOS": "jonction cardio-oesophagienne",
                                        "date": null,
                                        "author": "start",
                                        "comment": ""
                                    },
                                    "related": []
                                }
                            }
                        }
                    }
                }
            }
        },
        "cIMMASTERs": {
            "1059": {
                "attributes": {
                    "SID": "1059",
                    "sort": "C22.0",
                    "abbrev": "C220",
                    "LEVEL_": "5",
                    "type": "S",
                    "id1": "932",
                    "id2": "933",
                    "id3": "1013",
                    "id4": "1058",
                    "id5": "1059",
                    "id6": "0",
                    "id7": "0",
                    "valid": "1",
                    "date": null,
                    "author": "start",
                    "comment": " ",
                    "CIMO3": "1",
                    "code": "C22.0",
                    "LIBELLE": "carcinome h\u00e9patocellulaire"
                },
                "related": {
                    "cIMLIBELLEs": {
                        "\u0000CActiveRecord\u0000_new": {
                            "attributes": {
                                "LID": "32124",
                                "SID": "1059",
                                "source": "D",
                                "valid": "1",
                                "libelle": "",
                                "FR_OMS": "",
                                "EN_OMS": "Hepatocellular carcinoma",
                                "GE_DIMDI": "Carcinoma hepatocellulare",
                                "GE_AUTO": "Carcinoma hepatocellulare",
                                "FR_CHRONOS": "",
                                "date": null,
                                "author": "start",
                                "comment": " "
                            },
                            "related": []
                        }
                    }
                }
            }
        }
    }
}], ["lesion",
{
    "attributes": {
        "MORPHO": null,
        "ADICAP_ID": "2162",
        "CODE": "7730",
        "LIBELLE": "FIBROSE VISCERALE SYSTEMATISEE (SAI)",
        "ADICAP_GROUPE_ID": "16",
        "ADICAP_PARENT_ID": null
    },
    "related": {
        "aDICAPGROUPE": {
            "attributes": {
                "GROUPE_PARENT_ID": "4",
                "ADICAP_GROUPE_ID": "16",
                "NOM": "INFLAMMATION COMMUNE"
            },
            "related": {
                "gROUPEPARENT": {
                    "attributes": {
                        "GROUPE_PARENT_ID": null,
                        "ADICAP_GROUPE_ID": "4",
                        "NOM": "D4"
                    },
                    "related": []
                }
            }
        }
    }
}], ["code li\u00e9",
{
    "attributes": {
        "MORPHO": null,
        "ADICAP_ID": "4920",
        "CODE": "FF7730",
        "LIBELLE": "FIBROSE PORTALE ET PERIPORTALE - MICKELSEN   SYNDROME DE (SAI)",
        "ADICAP_GROUPE_ID": "6",
        "ADICAP_PARENT_ID": "89"
    },
    "related": {
        "aDICAPGROUPE": {
            "attributes": {
                "GROUPE_PARENT_ID": null,
                "ADICAP_GROUPE_ID": "6",
                "NOM": "D6"
            },
            "related": []
        },
        "aDICAPPARENT": {
            "attributes": {
                "MORPHO": null,
                "ADICAP_ID": "89",
                "CODE": "FF",
                "LIBELLE": "FOIE",
                "ADICAP_GROUPE_ID": "3",
                "ADICAP_PARENT_ID": "87"
            },
            "related": {
                "aDICAPGROUPE": {
                    "attributes": {
                        "GROUPE_PARENT_ID": null,
                        "ADICAP_GROUPE_ID": "3",
                        "NOM": "D3"
                    },
                    "related": []
                },
                "aDICAPPARENT": {
                    "attributes": {
                        "MORPHO": null,
                        "ADICAP_ID": "87",
                        "CODE": "FZ",
                        "LIBELLE": "FOIE- VOIES BILIAIRES- PANCREAS SAI",
                        "ADICAP_GROUPE_ID": "3",
                        "ADICAP_PARENT_ID": null
                    },
                    "related": {
                        "aDICAPGROUPE": {
                            "attributes": {
                                "GROUPE_PARENT_ID": null,
                                "ADICAP_GROUPE_ID": "3",
                                "NOM": "D3"
                            },
                            "related": []
                        },
                        "cIMMASTERs": {
                            "1084": {
                                "attributes": {
                                    "SID": "1084",
                                    "sort": "C26.8",
                                    "abbrev": "C268",
                                    "LEVEL_": "5",
                                    "type": "S",
                                    "id1": "932",
                                    "id2": "933",
                                    "id3": "1013",
                                    "id4": "1081",
                                    "id5": "1084",
                                    "id6": "0",
                                    "id7": "0",
                                    "valid": "1",
                                    "date": null,
                                    "author": "start",
                                    "comment": " ",
                                    "CIMO3": "1",
                                    "code": "C26.8",
                                    "LIBELLE": "l\u00e9sion \u00e0 localisations contigu\u00ebs de l'appareil digestif"
                                },
                                "related": {
                                    "cIMLIBELLEs": {
                                        "\u0000CActiveRecord\u0000_new": {
                                            "attributes": {
                                                "LID": "29475",
                                                "SID": "1084",
                                                "source": "E",
                                                "valid": "1",
                                                "libelle": "jonction cardio-oesophagienne",
                                                "FR_OMS": "jonction cardio-oesophagienne",
                                                "EN_OMS": "cardio-oesophageal junction",
                                                "GE_DIMDI": "Speiser\u00f6hren-Magen-\u00dcbergang",
                                                "GE_AUTO": "Speiser\u00f6hren-Magen-\u00dcbergang",
                                                "FR_CHRONOS": "jonction cardio-oesophagienne",
                                                "date": null,
                                                "author": "start",
                                                "comment": ""
                                            },
                                            "related": []
                                        }
                                    }
                                }
                            }
                        }
                    }
                },
                "cIMMASTERs": {
                    "1059": {
                        "attributes": {
                            "SID": "1059",
                            "sort": "C22.0",
                            "abbrev": "C220",
                            "LEVEL_": "5",
                            "type": "S",
                            "id1": "932",
                            "id2": "933",
                            "id3": "1013",
                            "id4": "1058",
                            "id5": "1059",
                            "id6": "0",
                            "id7": "0",
                            "valid": "1",
                            "date": null,
                            "author": "start",
                            "comment": " ",
                            "CIMO3": "1",
                            "code": "C22.0",
                            "LIBELLE": "carcinome h\u00e9patocellulaire"
                        },
                        "related": {
                            "cIMLIBELLEs": {
                                "\u0000CActiveRecord\u0000_new": {
                                    "attributes": {
                                        "LID": "32124",
                                        "SID": "1059",
                                        "source": "D",
                                        "valid": "1",
                                        "libelle": "",
                                        "FR_OMS": "",
                                        "EN_OMS": "Hepatocellular carcinoma",
                                        "GE_DIMDI": "Carcinoma hepatocellulare",
                                        "GE_AUTO": "Carcinoma hepatocellulare",
                                        "FR_CHRONOS": "",
                                        "date": null,
                                        "author": "start",
                                        "comment": " "
                                    },
                                    "related": []
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}], ["topographie compl\u00e9mentaire", null], ["tumeur primitive", null]] </code></pre>
            </div>

        </div>
    </div>