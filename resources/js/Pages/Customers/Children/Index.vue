<template>
    <AuthenticatedLayout>
        <h2 class="intro-y text-lg font-medium mt-10">
            {{ t("admin.users.children") + " " + props.user.full_name }}
        </h2>
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div
                class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2"
            >
                <Link
                    class="btn btn-primary shadow-md mr-2"
                    :href="
                        route('dashboard.child.create', {
                            user: props.user.uuid,
                        })
                    "
                >
                    {{ t("admin.add") + " " + t("admin.users.child") }}
                </Link>
            </div>
            <div class="col-span-3">
                <label class="form-label block">Search</label>
                <input
                    type="text"
                    class="form-control w-56 box pr-10"
                    v-model="form.search"
                    placeholder="Search..."
                />
            </div>
            <div class="col-span-3">
                <label for="crud-form-2" class="form-label">{{
                    t("admin.gender.main")
                }}</label>
                <TomSelect
                    id="crud-form-2"
                    v-model="form.gender"
                    class="w-full"
                    :options="{
                        create: false,
                    }"
                >
                    <option value="">
                        {{ t("admin.approved_statuses.all") }}
                    </option>
                    <option value="1">
                        {{ t("admin.gender.male") }}
                    </option>
                    <option value="2">
                        {{ t("admin.gender.female") }}
                    </option>
                </TomSelect>
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
                                {{ t("validation.attributes.name") }}
                            </th>
                            <th class="whitespace-nowrap">
                                {{ t("validation.attributes.date_of_birth") }}
                            </th>
                            <th class="text-center whitespace-nowrap">
                                {{ t("validation.attributes.gender") }}
                            </th>
                            <th class="text-center whitespace-nowrap">
                                {{ t("admin.actions") }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="(child, fakerKey) in props.children"
                            :key="fakerKey"
                            class="intro-x"
                        >
                            <td>
                                {{ fakerKey }}
                            </td>
                            <td>
                                {{ child.full_name }}
                            </td>
                            <td>
                                {{ child.date_of_birth }}
                            </td>
                            <td class="text-center">{{ child.gender }}</td>
                            <td class="table-report__action w-56">
                                <div class="flex justify-center items-center">
                                    <Link
                                        class="flex items-center mr-3"
                                        :href="
                                            route('dashboard.child.edit', {
                                                user: user.uuid,
                                                child: child.uuid,
                                            })
                                        "
                                    >
                                        <CheckSquareIcon class="w-4 h-4 mr-1" />
                                        {{ t("admin.update") }}
                                    </Link>
                                    <a
                                        class="flex items-center text-danger"
                                        href="javascript:;"
                                        @click="openDeleteModal(child.uuid)"
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
            ></div>
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
    routingParam,
} from "@/Composables/DeleteModalFunctions";
import { watch } from "@vue/runtime-core";

const { t } = useI18n(); // use as global scope
const props = defineProps({
    children: Array,
    user: Object,
});
const form = useForm({
    search: "",
    gender: "",
});
watch(form, (newForm) => {
    _.debounce(() => {
        Inertia.reload({
            only: ["children"],
            preserveState: true,
            data: newForm,
        });
    }, 500)();
});
deleteRouteKey.value = "child";
routingParam.user = props.user.uuid;
deleteLink.value = "dashboard.child.destroy";
refreshRecords.value = "children";
</script>
<style></style>
