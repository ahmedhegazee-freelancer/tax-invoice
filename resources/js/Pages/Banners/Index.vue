<template>
    <AuthenticatedLayout>
        <h2 class="intro-y text-lg font-medium mt-10">
            {{ t("sidebar.banners") }}
        </h2>
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div
                class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2"
            >
                <Link
                    class="btn btn-primary shadow-md mr-2"
                    :href="route('dashboard.banner.create')"
                >
                    {{
                        t("admin.add") + " " + t("validation.attributes.banner")
                    }}
                </Link>
            </div>
            <!-- BEGIN: Data List -->
            <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                <table class="table table-report -mt-2">
                    <thead>
                        <tr>
                            <th class="whitespace-nowrap">
                                {{ t("validation.attributes.id") }}
                            </th>
                            <th class="whitespace-nowrap">
                                {{ t("validation.attributes.image") }}
                            </th>
                            <th class="whitespace-nowrap">
                                {{ t("validation.attributes.lang") }}
                            </th>
                            <th class="text-center whitespace-nowrap">
                                {{ t("admin.actions") }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="(banner, fakerKey) in props.banners.data"
                            :key="fakerKey"
                            class="intro-x"
                        >
                            <td>
                                {{
                                    fakerKey +
                                    1 +
                                    15 * (props.banners.current_page - 1)
                                }}
                            </td>
                            <td>
                                <img
                                    :src="banner.formatted_url"
                                    width="200"
                                    height="200"
                                />
                            </td>
                            <td>{{ banner.locale }}</td>
                            <td class="table-report__action w-56">
                                <div class="flex justify-center items-center">
                                    <a
                                        class="flex items-center text-danger"
                                        href="javascript:;"
                                        @click="openDeleteModal(banner.id)"
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
                <pagination :links="props.banners.links" />
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
    banners: Array,
});
deleteRouteKey.value = "banner";
deleteLink.value = "dashboard.banner.destroy";
refreshRecords.value = "banners";
</script>
<style></style>
