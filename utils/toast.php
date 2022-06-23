<?php

    class Toast{

        private $MESSAGE_BY_TYPES = [
            'product-family-success' => ['variant'=> 'success', 'message'=> 'Registro criado com sucesso!'],
            'product-success' => ['variant'=> 'success', 'message'=> 'Produto criado com sucesso!'],
            'product-error' => ['variant'=> 'error', 'message'=> 'Erro ao criar produto!'],
            'stock-success' => ['variant'=> 'success', 'message'=> 'Produto adicionado ao estoque com sucesso!'],
            'stock-error' => ['variant'=> 'error', 'message'=> 'Erro ao inserir o produto no estoque!'],
            'price-table-success' => ['variant'=> 'success', 'message'=> 'tabela de preço criada com sucesso!'],
            'register-error' => ['variant'=> 'error', 'message'=> 'Erro ao abrir o caixa!'],
            'customer-error' => ['variant'=> 'error', 'message'=> 'Erro ao cadastrar cliente!'],
            'customer-success' => ['variant'=> 'success', 'message'=> 'Cliente cadastrado com sucesso!'],
            'has-open-register'=> ['variant'=> 'error', 'message'=> 'Existe um caixa aberto anterior ao dia de hoje. Por favor feche-o e abra um novo caixa!'],
            'register-success' => ['variant'=> 'success', 'message'=> 'Caixa fechado com sucesso!'],
            'register-error' => ['variant'=> 'error', 'message'=> 'Erro ao fechar o caixa!'],
            'purchase-success' => ['variant'=> 'success', 'message'=> 'Pedido fechado com sucesso!'],
            'purchase-error' => ['variant'=> 'error', 'message'=> 'Erro ao fechar o pedido!'],
        ];

        public function showToast($toastType){

            switch ($this->MESSAGE_BY_TYPES[$toastType]['variant']) {
                case 'success': {
                    return $this->toastSuccess($this->MESSAGE_BY_TYPES[$toastType]['message']);
                    break;
                }

                case 'error': {
                    return $this->toastError($this->MESSAGE_BY_TYPES[$toastType]['message']);
                    break;
                }
            }
        }

        public function toastSuccess($message){
            return $this->toast($message, 'slds-theme_success', 'success');
        }

        public function toastError($message){

            $test = $this->toast($message, 'slds-theme_error', 'error');
            return $test;
        }

        public function toast($message, $theme, $variant){

            return '
            <div class="slds-notify_container" id="close-toast">
                <div class="slds-notify slds-notify_toast '.$theme.'" role="status">
                    <span class="slds-assistive-text">'.$variant.'</span>
        
                    <div class="slds-notify__content">
                        <h2 class="slds-text-heading_small ">'. $message .'</h2>
                    </div>
                    <div class="slds-notify__close">
                        <button class="button-close" title="Close" onclick="closeToast()">
                            <span class="label-close">X</span>
                        </button>
                    </div>
                </div>
            </div>';
        }
    }
?>