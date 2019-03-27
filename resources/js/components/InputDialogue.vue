<template>
    <!-- template for the modal component -->
    <script type="text/x-template" id="modal-template">
        <transition name="modal">
            <div class="modal-mask">
                <div class="modal-wrapper">
                    <div class="modal-container">

                        <div class="modal-header">
                            <slot name="header">
                                default header
                            </slot>
                        </div>

                        <div class="modal-body">
                            <slot name="body">
                                default body
                            </slot>
                        </div>

                        <div class="modal-footer">
                            <slot name="footer">
                                <button class="btn btn-default" @click="$emit('close')">
                                    Close
                                </button>
                            </slot>
                        </div>
                    </div>
                </div>
            </div>
        </transition>
    </script>
</template>
<!--You dont need any script here-->