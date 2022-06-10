<?php

    class Toast{

        private $MESSAGE_BY_TYPES = [
            'product-family-success' => ['variant'=> 'success', 'message'=> 'Registro criado com sucesso!'],
            'product-success' => ['variant'=> 'success', 'message'=> 'Produto criado com sucesso!'],
            'price-table-success' => ['variant'=> 'success', 'message'=> 'tabela de preço criada com sucesso!'],
        ];

        public function showToast($toastType){

            switch ($this->MESSAGE_BY_TYPES[$toastType]['variant']) {
                case 'success':
                    return $this->toastSuccess($this->MESSAGE_BY_TYPES[$toastType]['message']);
                    break;
            }
        }

        public function toastSuccess($message){
            return $this->toast($message, 'slds-theme_success', 'success');
        }

        public function toastError($message){
            return toast($message, 'slds-theme_error', 'error');
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