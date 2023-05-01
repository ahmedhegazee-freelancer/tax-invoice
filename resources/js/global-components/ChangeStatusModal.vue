<template lang="">
    <Modal
        :show="changeStatusConfirmationModal"
        @hidden="changeStatusConfirmationModal = false"
    >
        <ModalBody class="p-0">
            <div class="p-5 text-center">
                <XCircleIcon class="w-16 h-16 text-danger mx-auto mt-3" />
                <div class="text-3xl mt-5">
                    {{ t("messages.Are you sure?") }}
                </div>
                <div class="text-slate-500 mt-2">
                    {{
                        t(
                            "messages.Do you really want to close this Race/Event?"
                        )
                    }}
                    <br />
                </div>
            </div>
            <div class="px-5 pb-8 text-center">
                <button
                    type="button"
                    @click="closeChangeStatusModal()"
                    class="btn btn-outline-secondary w-24 mr-1"
                >
                    {{ t("admin.cancel") }}
                </button>
                <button
                    type="button"
                    @click="confirmChangeStatus()"
                    class="btn btn-danger w-24"
                >
                    {{ t("admin.confirm") }}
                </button>
            </div>
        </ModalBody>
    </Modal>
</template>
<script setup>
import {
    confirmChangeStatus,
    closeChangeStatusModal,
} from "@/Composables/ChangeStatusModalFunctions";
import { useI18n } from "vue-i18n";
const { t } = useI18n();
const props = defineProps({
    changeStatusConfirmationModal: Boolean,
});
</script>
<style lang=""></style>
