<template>
    <AuthenticatedLayout>
        <h2 class="intro-y text-lg font-medium mt-10">
            {{ t("admin.customer-messages") }}
        </h2>
        <div class="grid grid-cols-12 gap-6 mt-5">
            <!-- BEGIN: Data List -->
            <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                <table class="table table-report -mt-2">
                    <thead>
                        <tr>
                            <th>{{ t("validation.attributes.id") }}</th>
                            <th class="whitespace-nowrap">
                                {{ t("validation.attributes.name") }}
                            </th>
                            <th class="text-center whitespace-nowrap">
                                {{ t("validation.attributes.message") }}
                            </th>
                            <th class="text-center whitespace-nowrap">
                                {{ t("admin.actions") }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="(message, fakerKey) in props.messages.data"
                            :key="fakerKey"
                            class="intro-x"
                        >
                            <td>
                                {{
                                    fakerKey +
                                    1 +
                                    15 * (props.messages.current_page - 1)
                                }}
                            </td>
                            <td>
                                {{ message.user.full_name }}
                            </td>
                            <td class="text-center">{{ message.message }}</td>

                            <td class="table-report__action w-56">
                                <div class="flex justify-center items-center">
                                    <a
                                        class="flex items-center text-danger"
                                        href="javascript:;"
                                        @click="openDeleteModal(message.id)"
                                    >
                                        <Trash2Icon class="w-4 h-4 mr-1" />
                                        {{ t("admin.delete") }}
                                    </a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- END: Data List -->
            <!-- BEGIN: Pagination -->
            <div
                class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center"
            >
                <pagination :links="props.messages.links" />
            </div>
            <!-- END: Pagination -->
        </div>
        <!-- BEGIN: Delete Confirmation Modal -->

        <DeleteModal
            :deleteConfirmationModal="deleteConfirmationModal"
        ></DeleteModal>
    </AuthenticatedLayout>
</template>
<script setup>
import { useI18n } from "vue-i18n";
import { ref } from "@vue/reactivity";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { useForm, usePage, Link } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import DeleteModal from "@/global-components/DeleteModal.vue";
// use as global scope
import {
    deleteLink,
    refreshRecords,
    deleteConfirmationModal,
    currentRecord,
    openDeleteModal,
    deleteRouteKey,
} from "@/Composables/DeleteModalFunctions";

const { t } = useI18n(); // use as global scope
const props = defineProps({
    messages: Array,
});
deleteRouteKey.value = "message";

deleteLink.value = "dashboard.customer-message.destroy";
refreshRecords.value = "messages";
</script>
<style></style>
