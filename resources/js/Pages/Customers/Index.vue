<template>
    <AuthenticatedLayout>
        <h2 class="intro-y text-lg font-medium mt-10">
            {{ t("admin.users.customers") }}
        </h2>
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div
                class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2"
            >
                <div
                    class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0 flex justify-between"
                >
                    <div class="w-56 relative text-slate-500">
                        <input
                            type="text"
                            class="form-control w-56 box pr-10"
                            v-model="searchStatus"
                            placeholder="Search..."
                        />
                        <SearchIcon
                            class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0"
                        />
                    </div>
                    <button
                        type="button"
                        class="btn btn-primary ml-4"
                        @click="openNotificationModal()"
                    >
                        {{ t("admin.send_notification") }}
                    </button>
                </div>
            </div>
            <!-- BEGIN: Data List -->
            <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                <table class="table table-report -mt-2">
                    <thead>
                        <tr>
                            <th class="whitespace-nowrap">
                                {{ t("validation.attributes.profile_image") }}
                            </th>
                            <th class="whitespace-nowrap">
                                {{ t("validation.attributes.name") }}
                            </th>
                            <th class="text-center whitespace-nowrap">
                                {{ t("validation.attributes.email") }}
                            </th>
                            <th class="text-center whitespace-nowrap">
                                {{ t("validation.attributes.phone") }}
                            </th>
                            <th class="text-center whitespace-nowrap">
                                {{ t("admin.status") }}
                            </th>
                            <th class="text-center whitespace-nowrap">
                                {{ t("admin.actions") }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="(customer, fakerKey) in props.customers.data"
                            :key="fakerKey"
                            class="intro-x"
                        >
                            <td class="w-40">
                                <div class="flex">
                                    <div
                                        class="w-10 h-10 image-fit zoom-in -ml-5"
                                    >
                                        <Tippy
                                            tag="img"
                                            alt="Profile"
                                            class="rounded-full"
                                            :src="customer.profile_photo_url"
                                        />
                                    </div>
                                </div>
                            </td>
                            <td>
                                {{ customer.full_name }}
                            </td>
                            <td class="text-center">{{ customer.email }}</td>
                            <td class="text-center">{{ customer.phone }}</td>
                            <td class="w-40">
                                <div
                                    class="flex items-center justify-center"
                                    :class="{
                                        'text-success': !customer.is_blocked,
                                        'text-danger': customer.is_blocked,
                                    }"
                                >
                                    <CheckSquareIcon class="w-4 h-4 mr-2" />
                                    {{
                                        customer.is_blocked
                                            ? "Blocked"
                                            : "Unblocked"
                                    }}
                                </div>
                            </td>
                            <td class="table-report__action w-56">
                                <div class="flex justify-center items-center">
                                    <Link
                                        class="flex items-center mr-3"
                                        :href="
                                            route('dashboard.child.index', {
                                                user: customer.uuid,
                                            })
                                        "
                                    >
                                        <UsersIcon class="w-4 h-4 mr-1" />
                                        {{ t("admin.users.children") }}
                                    </Link>
                                    <Link
                                        class="flex items-center mr-3"
                                        :href="
                                            route('dashboard.customer.edit', {
                                                user: customer.uuid,
                                            })
                                        "
                                    >
                                        <CheckSquareIcon class="w-4 h-4 mr-1" />
                                        {{ t("admin.update") }}
                                    </Link>
                                    <a
                                        class="flex items-center text-danger"
                                        href="javascript:;"
                                        @click="openDeleteModal(customer.uuid)"
                                    >
                                        <Trash2Icon class="w-4 h-4 mr-1" />
                                        {{ t("admin.delete") }}
                                    </a>
                                    <a
                                        class="flex items-center text-danger"
                                        href="javascript:;"
                                        @click="
                                            openToggleBlockModal(customer.uuid)
                                        "
                                        v-if="!customer.is_blocked"
                                    >
                                        <SlashIcon class="w-4 h-4 mr-1" />
                                        {{ t("admin.block") }}
                                    </a>
                                    <a
                                        class="flex items-center text-success"
                                        href="javascript:;"
                                        v-if="customer.is_blocked"
                                        @click="
                                            openToggleBlockModal(customer.uuid)
                                        "
                                    >
                                        <CheckIcon class="w-4 h-4 mr-1" />
                                        {{ t("admin.unblock") }}
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
                <pagination :links="props.customers.links" />
            </div>
            <!-- END: Pagination -->
        </div>
        <!-- BEGIN: Delete Confirmation Modal -->
        <DeleteModal
            :deleteConfirmationModal="deleteConfirmationModal"
        ></DeleteModal>
        <BlockModal
            :toggleBlockConfirmationModal="toggleBlockConfirmationModal"
        ></BlockModal>
        <NotificationModal
            :showModal="showNotificationModal"
            @close="showNotificationModal = false"
        />
    </AuthenticatedLayout>
</template>
<script setup>
import { useI18n } from "vue-i18n";
import { ref } from "@vue/reactivity";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { useForm, usePage, Link } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import DeleteModal from "@/global-components/DeleteModal.vue";
import BlockModal from "@/global-components/BlockModal.vue";

// use as global scope
import {
    deleteLink,
    refreshRecords,
    deleteConfirmationModal,
    currentRecord,
    openDeleteModal,
    deleteRouteKey,
} from "@/Composables/DeleteModalFunctions";

import {
    toggleBlockConfirmationModal,
    openToggleBlockModal,
    closeToggleBlockModal,
    confirmToggleBlock,
} from "@/Composables/BlockModalFunctions";
import { watch } from "@vue/runtime-core";
import NotificationModal from "@/Components/NotificationModal.vue";
deleteRouteKey.value = "user";
const searchStatus = ref("");
deleteLink.value = "dashboard.customer.destroy";
refreshRecords.value = "customers";
const { t } = useI18n(); // use as global scope
const props = defineProps({
    customers: Array,
});
const showNotificationModal = ref(false);
watch(searchStatus, (newSearch) => {
    _.debounce(() => {
        Inertia.reload({
            only: ["customers"],
            preserveState: true,
            data: {
                search: newSearch,
            },
        });
    }, 500)();
});
const openNotificationModal = () => {
    showNotificationModal.value = true;
};
</script>
<style></style>
