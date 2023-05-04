<template>
    <AuthenticatedLayout>
        <h2 class="intro-y text-lg font-medium mt-10">
            {{ t("sidebar.branchs") }}
        </h2>
        <div class="grid grid-cols-12 gap-6 mt-5">
            <!-- <div
                class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2"
            >
                <Link
                    class="btn btn-primary shadow-md mr-2"
                    :href="route('dashboard.branch.create')"
                >
                    {{
                        t("admin.add") + " " + t("validation.attributes.branch")
                    }}
                </Link>
            </div> -->
            <!-- BEGIN: Data List -->
            <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                <table class="table table-report -mt-2">
                    <thead>
                        <tr>
                            <th class="whitespace-nowrap">
                                {{ t("validation.attributes.id") }}
                            </th>

                            <th class="whitespace-nowrap">
                                {{ t("validation.attributes.name") }}
                            </th>
                            <th class="whitespace-nowrap">
                                {{ t("validation.attributes.branch_code") }}
                            </th>
                            <th class="whitespace-nowrap">
                                {{ t("validation.attributes.activity_code") }}
                            </th>
                            <th class="text-center whitespace-nowrap">
                                {{ t("admin.actions") }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="(branch, fakerKey) in props.branches.data"
                            :key="fakerKey"
                            class="intro-x"
                        >
                            <td>
                                {{ fakerKey }}
                            </td>
                            <td>
                                {{ branch.name }}
                            </td>
                            <td>{{ branch.branch_code }}</td>
                            <td>{{ branch.activity_code }}</td>
                            <td class="table-report__action w-56">
                                <div class="flex justify-center items-center">
                                    <a
                                        class="flex items-center text-danger"
                                        href="javascript:;"
                                        @click="openDeleteModal(branch.id)"
                                    >
                                        <Trash2Icon class="w-4 h-4 mr-1" />
                                        {{ t("admin.delete") }}
                                    </a>
                                    <Link
                                        class="flex items-center mr-3"
                                        :href="
                                            route(
                                                'dashboard.credential.index',
                                                {
                                                    branch: branch.id,
                                                }
                                            )
                                        "
                                    >
                                        <LockIcon class="w-4 h-4 mr-1" />
                                        {{
                                            t(
                                                "validation.attributes.credential"
                                            )
                                        }}
                                    </Link>
                                    <Link
                                        class="flex items-center mr-3"
                                        :href="
                                            route('dashboard.address.index', {
                                                branch: branch.id,
                                            })
                                        "
                                    >
                                        <MapPinIcon class="w-4 h-4 mr-1" />
                                        {{ t("validation.attributes.address") }}
                                    </Link>
                                    <Link
                                        class="flex items-center mr-3"
                                        :href="
                                            route(
                                                'dashboard.branch.invoices.index',
                                                {
                                                    branch: branch.id,
                                                }
                                            )
                                        "
                                    >
                                        <ListIcon class="w-4 h-4 mr-1" />
                                        Invoices
                                    </Link>
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
                <pagination :links="props.branches.links" />
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
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Link } from "@inertiajs/inertia-vue3";
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
const { t } = useI18n();
const props = defineProps({
    branches: Object,
});
deleteRouteKey.value = "branch";
deleteLink.value = "dashboard.branch.destroy";
refreshRecords.value = "branches";
</script>
<style></style>
