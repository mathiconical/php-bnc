<?php

namespace Mathiconical\PhpBnc;

use stdClass;
use Mathiconical\PhpBnc\BncLote;

final class BncProcesso
{
    /**
     * Identificador interno do processo
     * Envio obrigatório em caso de atualização dos dados do processo.
     * @var int
     */
    public $idIntegProcess;

    /**
     * Modalidade do processo.
     * 1 – PREGÃO ELETRÔNICO
     * 3 – DISPENSA ELETRÔNICA
     * 4 – CONCORRÊNCIA ELETRÔNICA
     * 6 – REGIME DIFERENCIADO DE COMPRAS
     * @var int
     */
    public $fkModality;

    /**
     * Tipo de contrato.
     * 1 - AQUISIÇÃO
     * 2 - REGISTRO DE PREÇO
     * 3 - AQUISIÇÃO PARCELADA
     * @var int
     */
    public $fkContractKind;

    /**
     * Tipo de disputa.
     * 1 - MENOR LANCE
     * 2 - MAIOR DESCONTO
     * 3 - MAIOR LANCE
     * @var int
     */
    public $fkDisputeKind;

    /**
     * Número do processo.
     * Min. 7 e Max. 12 caracteres.
     * @var int|string
     */
    public $Number;

    /**
     * Número do processo administrativo.
     * Max. 20 caracteres.
     * @var int|string
     */
    public $AdmNumber;

    /**
     * Processo exclusivo para ME/EPP integralmente.
     * @var boolean
     */
    public $IsMeExclusive;

    /**
     * Inicio de recebimento de propostas.
     * Formato 2020-01-01T08:00:00
     * @var string
     */
    public $ProposalReceivingStart;

    /**
     * Fim do recebimento de propostas.
     * Formato 2020-01-01T08:00:00
     * @var string
     */
    public $ProposalAnalysisStart;

    /**
     * Início da disputa.
     * Formato 2020-01-01T08:00:00
     * @var string
     */
    public $DisputeStart;

    /**
     * Meses de duração de contrato.
     * Max. 255 caracteres.
     * @var string
     */
    public $ContractExpiration;

    /**
     * Prazo de pagamento.
     * Max. 50 caracteres.
     * @var string
     */
    public $PaymentTerm;

    /**
     * Objeto da licitação.
     * Max. 255 caracteres.
     * @var string
     */
    public $ProductOrService;

    /**
     * Fim de recebimento de impugnações.
     * Formato 2020-01-01T08:00:00
     * @var string
     */
    public $ImpeachmentEndTime;

    /**
     * Fim de recebimento de esclarecimentos.
     * Formato 2020-01-01T08:00:00
     * @var string
     */
    public $ClarifyEndTime;

    /**
     * Regulamento, decreto municipal, estadual ou federal completo.
     * Max. 100 caracteres
     * @var string
     */
    public $Regulation;

    /**
     * Envio obrigatório à plataforma Mais Brasil.
     * @var boolean
     */
    public $IsMaisBrasilRequired;

    /**
     * Número do convênio Sincov.
     * 6 dígitos numéricos obrigatórios;
     * @var string
     */
    public $MaisBrasilAccord;

    /**
     * Ano do convênio Sincov
     * @var int
     */
    public $MaisBrasilAccordYear;

    /**
     * Ano referência do processo.
     * Ano atual ou anterior.
     * @var int
     */
    public $YearReference;

    /**
     * Identificador interno do exportador.
     * Max. 50 caracteres.
     * @var string
     */
    public $ExpProcessId;

    /**
     * Informações adicionais do exportador.
     * Max. 50 caracteres.
     * @var string
     */
    public $ExpInternalData;

    /**
     * Versão da integração, para compatibilização de versões antigas em atualizações.
     * Utilizar o número de versão atual: 2.
     * @var int
     */
    public $Version;

    /**
     * Relação de dados dos lotes que pertencem ao processo.
     * Pode ser utilizado para envio dos dados de lotes na mesma requisição.
     * Verificar as especificações no item 4 abaixo.
     * @var array<BncLote>
     */
    public $IntegBatch;

    /**
     * Versão padrão definida 2.
     * @param int $version
     */
    public function __construct(int $version = 2)
    {
        $this->idIntegProcess = null;
        $this->fkModality = null;
        $this->fkContractKind = null;
        $this->fkDisputeKind = null;
        $this->Number = null;
        $this->AdmNumber = null;
        $this->IsMeExclusive = null;
        $this->ProposalReceivingStart = null;
        $this->ProposalAnalysisStart = null;
        $this->DisputeStart = null;
        $this->ContractExpiration = null;
        $this->PaymentTerm = null;
        $this->ProductOrService = null;
        $this->ImpeachmentEndTime = null;
        $this->ClarifyEndTime = null;
        $this->Regulation = null;
        $this->IsMaisBrasilRequired = null;
        $this->MaisBrasilAccord = null;
        $this->MaisBrasilAccordYear = null;
        $this->YearReference = null;
        $this->ExpProcessId = null;
        $this->ExpInternalData = null;
        $this->Version = $version;
        $this->IntegBatch = [];
    }

    /**
     * Converter para objeto stdClass.
     * Campos nulos não serão considerados.
     * @return \stdClass
     */
    public function convertToObject(string $complementNumber = '', string $complementAdmNumber = '')
    {
        $obj = new stdClass();

        if ($this->idIntegProcess != null) {
            $obj->idIntegProcess = $this->idIntegProcess;
        }
        if ($this->fkModality != null) {
            $obj->fkModality = $this->fkModality;
        }
        if ($this->fkContractKind != null) {
            $obj->fkContractKind = $this->fkContractKind;
        }
        if ($this->fkDisputeKind != null) {
            $obj->fkDisputeKind = $this->fkDisputeKind;
        }
        if ($this->Number != null) {
            $temp = $complementNumber . $this->Number;
            $obj->Number = str_pad($temp, 12, '0', STR_PAD_LEFT);
        }
        if ($this->AdmNumber != null) {
            $temp = $complementAdmNumber . $this->AdmNumber;
            $obj->AdmNumber = str_pad($temp, 20, '0', STR_PAD_LEFT);
        }
        if ($this->IsMeExclusive != null) {
            $obj->IsMeExclusive = $this->IsMeExclusive;
        }
        if ($this->ProposalReceivingStart != null) {
            $obj->ProposalReceivingStart = $this->ProposalReceivingStart;
        }
        if ($this->ProposalAnalysisStart != null) {
            $obj->ProposalAnalysisStart = $this->ProposalAnalysisStart;
        }
        if ($this->DisputeStart != null) {
            $obj->DisputeStart = $this->DisputeStart;
        }
        if ($this->ContractExpiration != null) {
            $obj->ContractExpiration = $this->ContractExpiration;
        }
        if ($this->PaymentTerm != null) {
            $obj->PaymentTerm = substr($this->PaymentTerm, 0, 50);
        }
        if ($this->ProductOrService != null) {
            $obj->ProductOrService = substr($this->ProductOrService, 0, 255);
        }
        if ($this->ImpeachmentEndTime != null) {
            $obj->ImpeachmentEndTime = $this->ImpeachmentEndTime;
        }
        if ($this->ClarifyEndTime != null) {
            $obj->ClarifyEndTime = $this->ClarifyEndTime;
        }
        if ($this->Regulation != null) {
            $obj->Regulation = $this->Regulation;
        }
        if ($this->IsMaisBrasilRequired != null) {
            $obj->IsMaisBrasilRequired = $this->IsMaisBrasilRequired;
        }
        if ($this->MaisBrasilAccord != null) {
            $obj->MaisBrasilAccord = $this->MaisBrasilAccord;
        }
        if ($this->MaisBrasilAccordYear != null) {
            $obj->MaisBrasilAccordYear = $this->MaisBrasilAccordYear;
        }
        if ($this->YearReference != null) {
            $obj->YearReference = $this->YearReference;
        }
        if ($this->ExpProcessId != null) {
            $obj->ExpProcessId = $this->ExpProcessId;
        }
        if ($this->ExpInternalData != null) {
            $obj->ExpInternalData = $this->ExpInternalData;
        }
        if ($this->Version != null) {
            $obj->Version = $this->Version;
        }
        if (count($this->IntegBatch) > 0) {
            $obj->IntegBatch = [];

            foreach ($this->IntegBatch as $element) {
                array_push($obj->IntegBatch, $element->convertToObject());
            }
        }

        return $obj;
    }
}
