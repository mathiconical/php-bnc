<?php

namespace Mathiconical\PhpBnc;

use stdClass;

final class BncItem
{
    /**
     * Número do item
     * @var int
     */
    public $Number;

    /**
     * Descrição/especificação.
     * Max. 2500 caracteres.
     * @var string
     */
    public $Description;

    /**
     * Unidade de medida.
     * Max. 50 caracteres.
     * @var int
     */
    public $Unity;

    /**
     * Quantidade.
     * 14 dígitos, 4 decimais
     * @var float
     */

    public $Quantity;

    /**
     * Valor de referência.
     * 14 dígitos, 4 decimais.
     * @var float
     */
    public $BaseValue;

    /**
     * Dado interno do exportador.
     * Pode ser utilizado para armazenar o código do produto do exportador
     * e/ou dados úteis ao exportador. Max. 100 caracteres.
     * @var string
     */
    public $AdditionalInfo;

    /**
     * Informações detalhadas/descrição detalhada requerida.
     * Caso valor seja verdadeiro, o sistema irá obrigar a inserção de texto
     * em campo específico para registro da proposta do item.
     * @var boolean
     */
    public $IsDetailRequired;

    /**
     * Upload de arquivo requerido para o item.
     * Caso valor seja verdadeiro, o sistema irá obrigar o upload de arquivo
     * em tela específica para registro da proposta do item.
     * @var boolean
     */
    public $IsFileRequired;

    public function __construct()
    {
        $this->Number = null;
        $this->Description = null;
        $this->Unity = null;
        $this->Quantity = null;
        $this->BaseValue = null;
        $this->AdditionalInfo = null;
        $this->IsDetailRequired = null;
        $this->IsFileRequired = null;
    }

    /**
     * Converter para objeto stdClass.
     * Campos nulos não serão considerados.
     * @return \stdClass
     */
    public function convertToObject()
    {
        $obj = new stdClass();

        if ($this->Number != null) {
            $obj->Number = $this->Number;
        }
        if ($this->Description != null) {
            $obj->Description = $this->Description;
        }
        if ($this->Unity != null) {
            $obj->Unity = $this->Unity;
        }
        if ($this->Quantity != null) {
            $obj->Quantity = $this->Quantity;
        }
        if ($this->BaseValue != null) {
            $obj->BaseValue = $this->BaseValue;
        }
        if ($this->AdditionalInfo != null) {
            $obj->AdditionalInfo = $this->AdditionalInfo;
        }
        if ($this->IsDetailRequired != null) {
            $obj->IsDetailRequired = $this->IsDetailRequired;
        }
        if ($this->IsFileRequired != null) {
            $obj->IsFileRequired = $this->IsFileRequired;
        }

        return $obj;
    }
}
