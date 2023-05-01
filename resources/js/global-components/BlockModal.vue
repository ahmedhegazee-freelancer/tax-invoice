<template lang="">
    <Modal
        :show="toggleBlockConfirmationModal"
        @hidden="toggleBlockConfirmationModal = false"
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
                            "messages.Do you really want to block/unblock this record?"
                        )
                    }}
                    <br />
                </div>
            </div>
            <div class="px-5 pb-8 text-center">
                <button
                    type="button"
                    @click="closeToggleBlockModal()"
                    class="btn btn-outline-secondary w-24 mr-1"
                >
                    {{ t("admin.cancel") }}
                </button>
                <button
                    type="button"
                    @click="confirmToggleBlock()"
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
    closeToggleBlockModal,
    confirmToggleBlock,
} from "@/Composables/BlockModalFunctions";
import { useI18n } from "vue-i18n";
const { t } = useI18n();
const props = defineProps({
    toggleBlockConfirmationModal: Boolean,
});
</script>
<style lang=""></style>
