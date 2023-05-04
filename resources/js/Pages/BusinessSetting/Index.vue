<template>
    <AuthenticatedLayout>
        <h2 class="intro-y text-lg font-medium mt-10">Business Settings</h2>
        <div class="grid grid-cols-12 gap-6 mt-5">
            <!-- BEGIN: Data List -->
            <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                <table class="table table-report -mt-2">
                    <thead>
                        <tr>
                            <th class="whitespace-nowrap">
                                {{ t("validation.attributes.key") }}
                            </th>
                            <th class="whitespace-nowrap">
                                {{ t("validation.attributes.value") }}
                            </th>

                            <th class="text-center whitespace-nowrap">
                                {{ t("admin.actions") }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="(add, fakerKey) in props.settings"
                            :key="fakerKey"
                            class="intro-x"
                        >
                            <td>
                                {{ add.key }}
                            </td>
                            <td>
                                {{ add.value }}
                            </td>
                            <td class="table-report__action w-56">
                                <div class="flex justify-center items-center">
                                    <Link
                                        class="flex items-center mr-3"
                                        :href="
                                            route(
                                                'dashboard.business-setting.edit',
                                                {
                                                    setting: add.id,
                                                }
                                            )
                                        "
                                    >
                                        <EditIcon class="w-4 h-4 mr-1" />
                                        {{ t("admin.update") }}
                                    </Link>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- END: Data List -->
            <!-- BEGIN: Pagination -->
            <!-- <div
                class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center"
            >
                <pagination :links="props.credentials.links" />
            </div> -->
            <!-- END: Pagination -->
        </div>
        <!-- BEGIN: Delete Confirmation Modal -->
    </AuthenticatedLayout>
</template>
<script setup>
import { useI18n } from "vue-i18n";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Link } from "@inertiajs/inertia-vue3";
const { t } = useI18n();
const props = defineProps({
    settings: Array,
});
</script>
<style></style>
