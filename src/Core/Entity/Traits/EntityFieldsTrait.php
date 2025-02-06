<?php

namespace Debishev\Bitrix24Library\Core\Entity\Traits;

use DateTimeImmutable;

trait EntityFieldsTrait
{
    function isAtomDate($dateString): bool {
        if (!is_array($dateString)) {
            $date = DateTimeImmutable::createFromFormat(DATE_ATOM, $dateString);
            return $date && $date->format(DATE_ATOM) === $dateString;
        }
        return false;
    }


    function fillData(array $data): void
    {
        if (!empty($data)) {
            $cFields = [];
            foreach ($data as $key => $value) {

                if (str_starts_with($key, 'UF_CRM_')
                    || str_starts_with($key, 'ufCrm')
                    || str_starts_with($key, 'UF_USR')
                    || str_starts_with($key, 'PROPERTY_') ){
                    $cFields[$key] = $value;
                } else {
                    if (property_exists($this, $key)) {
                        if ($this->isAtomDate($value)) {
                            if (!empty($value)) {
                                $this->$key = DateTimeImmutable::createFromFormat(DATE_ATOM, $value);
                            } else {
                                $this->$key = null;
                            }
                        } elseif ($key == 'quantity' || $key == 'opportunity') {
                            if ($value != null && $value != '') {
                                $this->$key = floatval($value);
                            }  else {
                                $this->$key = floatval(0);
                            }
                        }
                        else {
                            if (!is_array($value)) {
                                if (strlen($value) > 0) {
                                    $this->$key = $value;
                                } else {
                                    $this->$key = null;
                                }
                            } else {
                                $this->$key = $value;
                            }

                        }

                    }
                }




            }

            if (!empty($cFields)) {
                $this->customFields = $cFields;
            }
        }
    }
}