<?php

namespace Mathiconical\PhpBnc;

use stdClass;
use Mathiconical\PhpBnc\BncItem;

final class BncLote
{
    /**
     * Tipo de lance
     * 1 - UNITÁRIO
     * 2 - GLOBAL
     * 3 - KIT
     * @var int
     */
    public $fkBidKind;

    /**
     * Número do lote
     * @var int
     */
    public $Number;

    /**
     * Título
     * Se não informado, o sistema irá atribuir um título padrão com base no número do lote. Max. 255 caracteres.
     * @var string
     */
    public $Title;

    /**
     * Quantidade
     * @var int
     */
    public $Quantity;

    /**
     * Local de entrega.
     * Max. 200 caracteres.
     * @var string
     */
    public $DeliveryPlace;

    /**
     * Garantia
     * Max. 100 caracteres
     * @var string
     */
    public $Warranty;

    /**
     * Margem de lance.
     * 14 dígitos, 4 decimais
     * @var float
     */
    public $BidMargin;

    /**
     * Exclusivo para ME/EPP.
     * true ou false
     * @var boolean
     */
    public $IsMeExclusive;

    /**
     * Exclusivo para fornecedores localizados na regionalidade cadastrada para o promotor.
     * true ou false
     * @var boolean
     */
    public $IsRegional;

    /**
     * Relação de dados dos itens que pertencem ao lote.
     * Array<IntegBatchItem>/Coleção do tipo IntegBatchitem
     * @var array<BncItem>
     */
    public $IntegBatchItem;

    public function __construct()
    {
        $this->fkBidKind = null;
        $this->Number = null;
        $this->Title = null;
        $this->Quantity = null;
        $this->DeliveryPlace = null;
        $this->Warranty = null;
        $this->BidMargin = null;
        $this->IsMeExclusive = null;
        $this->IsRegional = null;
        $this->IntegBatchItem = [];
    }

    /**
     * Converter para objeto stdClass.
     * Campos nulos não serão considerados.
     * @return \stdClass
     */
    public function convertToObject()
    {
        $obj = new stdClass();

        if ($this->fkBidKind != null) {
            $obj->fkBidKind = $this->fkBidKind;
        }
        if ($this->Number != null) {
            $obj->Number = $this->Number;
        }
        if ($this->Title != null) {
            $obj->Title = $this->Title;
        }
        if ($this->Quantity != null) {
            $obj->Quantity = $this->Quantity;
        }
        if ($this->DeliveryPlace != null) {
            $obj->DeliveryPlace = $this->DeliveryPlace;
        }
        if ($this->Warranty != null) {
            $obj->Warranty = $this->Warranty;
        }
        if ($this->BidMargin != null) {
            $obj->BidMargin = $this->BidMargin;
        }
        if ($this->IsMeExclusive != null) {
            $obj->IsMeExclusive = $this->IsMeExclusive;
        }
        if ($this->IsRegional != null) {
            $obj->IsRegional = $this->IsRegional;
        }
        if (count($this->IntegBatchItem) > 0) {
            $obj->IntegBatchItem = [];

            foreach ($this->IntegBatchItem as $element) {
                array_push($obj->IntegBatchItem, $element->convertToObject());
            }
        }

        return $obj;
    }
}
