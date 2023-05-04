<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import { useI18n } from "vue-i18n";
const { t } = useI18n();
const props = defineProps({
    customers: Number,
    transactions: Number,
    availableRacesCount: Number,
    bookings: Number,
    races: Array,
    events: Array,
});
</script>

<template>
    <Head title="Dashboard" />
    <AuthenticatedLayout>
        <div class="grid grid-cols-12 gap-6">
            <div class="col-span-12 2xl:col-span-9">
                <div class="grid grid-cols-12 gap-6">
                    <!-- BEGIN: General Report -->
                    <!-- <div class="col-span-12 mt-8">
                        <div class="intro-y flex items-center h-10">
                            <h2 class="text-lg font-medium truncate mr-5">
                                General Report
                            </h2>
                        </div>
                        <div class="grid grid-cols-12 gap-6 mt-5">
                            <div
                                class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y"
                            >
                                <div class="report-box zoom-in">
                                    <div class="box p-5">
                                        <div class="flex">
                                            <ShoppingCartIcon
                                                class="report-box__icon text-primary"
                                            />
                                        </div>
                                        <div
                                            class="text-3xl font-medium leading-8 mt-6"
                                        >
                                            {{ props.transactions }}
                                        </div>
                                        <div
                                            class="text-base text-slate-500 mt-1"
                                        >
                                            Transactions
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y"
                            >
                                <div class="report-box zoom-in">
                                    <div class="box p-5">
                                        <div class="flex">
                                            <CreditCardIcon
                                                class="report-box__icon text-pending"
                                            />
                                        </div>
                                        <div
                                            class="text-3xl font-medium leading-8 mt-6"
                                        >
                                            {{ props.bookings }}
                                        </div>
                                        <div
                                            class="text-base text-slate-500 mt-1"
                                        >
                                            Bookings
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y"
                            >
                                <div class="report-box zoom-in">
                                    <div class="box p-5">
                                        <div class="flex">
                                            <MonitorIcon
                                                class="report-box__icon text-warning"
                                            />
                                        </div>
                                        <div
                                            class="text-3xl font-medium leading-8 mt-6"
                                        >
                                            {{ props.availableRacesCount }}
                                        </div>
                                        <div
                                            class="text-base text-slate-500 mt-1"
                                        >
                                            Available Races
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y"
                            >
                                <div class="report-box zoom-in">
                                    <div class="box p-5">
                                        <div class="flex">
                                            <UserIcon
                                                class="report-box__icon text-success"
                                            />
                                        </div>
                                        <div
                                            class="text-3xl font-medium leading-8 mt-6"
                                        >
                                            {{ props.customers }}
                                        </div>
                                        <div
                                            class="text-base text-slate-500 mt-1"
                                        >
                                            Customers
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <!-- END: General Report -->
                    <!-- BEGIN: Sales Report -->

                    <!-- <div class="col-span-12 mt-6">
                        <div class="intro-y block sm:flex items-center h-10">
                            <h2 class="text-lg font-medium truncate mr-5">
                                Races
                            </h2>
                            <div
                                class="flex items-center sm:ml-auto mt-3 sm:mt-0"
                            >
                                <Link
                                    class="btn box flex items-center text-slate-600 dark:text-slate-300"
                                    :href="route('dashboard.race.index')"
                                >
                                    <MenuIcon
                                        class="hidden sm:block w-4 h-4 mr-2"
                                    />
                                    Show all
                                </Link>
                            </div>
                        </div>
                        <div
                            class="intro-y overflow-auto lg:overflow-visible mt-8 sm:mt-0"
                        >
                            <table class="table table-report -mt-2">
                                <thead>
                                    <tr>
                                        <th class="whitespace-nowrap">
                                            {{ t("validation.attributes.id") }}
                                        </th>
                                        <th class="whitespace-nowrap">
                                            {{
                                                t("validation.attributes.title")
                                            }}
                                        </th>
                                        <th class="whitespace-nowrap">
                                            {{
                                                t(
                                                    "validation.attributes.address"
                                                )
                                            }}
                                        </th>
                                        <th class="whitespace-nowrap">
                                            {{
                                                t("validation.attributes.event")
                                            }}
                                        </th>
                                        <th class="whitespace-nowrap">
                                            {{
                                                t(
                                                    "validation.attributes.status"
                                                )
                                            }}
                                        </th>
                                        <th class="whitespace-nowrap">
                                            {{
                                                t(
                                                    "validation.attributes.start_date"
                                                )
                                            }}
                                        </th>
                                        <th
                                            class="text-center whitespace-nowrap"
                                        >
                                            {{ t("admin.actions") }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        v-for="(race, fakerKey) in props.races
                                            .data"
                                        :key="fakerKey"
                                        class="intro-x"
                                    >
                                        <td>
                                            {{
                                                fakerKey +
                                                1 +
                                                15 *
                                                    (props.races.current_page -
                                                        1)
                                            }}
                                        </td>
                                        <td>
                                            {{ race.title }}
                                        </td>
                                        <td>
                                            {{ race.address }}
                                        </td>
                                        <td>
                                            {{ race.event.title }}
                                        </td>
                                        <td>
                                            {{ race.formatted_status }}
                                        </td>
                                        <td>{{ race.start_date }}</td>
                                        <td class="table-report__action w-56">
                                            <div
                                                class="flex justify-center items-center"
                                            >
                                                <Link
                                                    class="flex items-center mr-3"
                                                    :href="
                                                        route(
                                                            'dashboard.race-media.index',
                                                            {
                                                                race: race.uuid,
                                                            }
                                                        )
                                                    "
                                                >
                                                    <ImageIcon
                                                        class="w-4 h-4 mr-1"
                                                    />
                                                    {{
                                                        t(
                                                            "validation.attributes.media"
                                                        )
                                                    }}
                                                </Link>
                                                <Link
                                                    class="flex items-center mr-3"
                                                    :href="
                                                        route(
                                                            'dashboard.detail.index',
                                                            {
                                                                race: race.uuid,
                                                            }
                                                        )
                                                    "
                                                >
                                                    <FileTextIcon
                                                        class="w-4 h-4 mr-1"
                                                    />
                                                    {{
                                                        t(
                                                            "validation.attributes.media"
                                                        )
                                                    }}
                                                </Link>
                                                <Link
                                                    class="flex items-center mr-3"
                                                    :href="
                                                        route(
                                                            'dashboard.race.edit',
                                                            {
                                                                race: race.uuid,
                                                            }
                                                        )
                                                    "
                                                >
                                                    <CheckSquareIcon
                                                        class="w-4 h-4 mr-1"
                                                    />
                                                    {{ t("admin.update") }}
                                                </Link>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-span-12 mt-6">
                        <div class="intro-y block sm:flex items-center h-10">
                            <h2 class="text-lg font-medium truncate mr-5">
                                Events
                            </h2>
                            <div
                                class="flex items-center sm:ml-auto mt-3 sm:mt-0"
                            >
                                <Link
                                    class="btn box flex items-center text-slate-600 dark:text-slate-300"
                                    :href="route('dashboard.event.index')"
                                >
                                    <MenuIcon
                                        class="hidden sm:block w-4 h-4 mr-2"
                                    />
                                    Show all
                                </Link>
                            </div>
                        </div>
                        <div
                            class="intro-y overflow-auto lg:overflow-visible mt-8 sm:mt-0"
                        >
                            <table class="table table-report -mt-2">
                                <thead>
                                    <tr>
                                        <th class="whitespace-nowrap">
                                            {{ t("validation.attributes.id") }}
                                        </th>
                                        <th class="whitespace-nowrap">
                                            {{
                                                t("validation.attributes.title")
                                            }}
                                        </th>
                                        <th class="whitespace-nowrap">
                                            {{
                                                t(
                                                    "validation.attributes.address"
                                                )
                                            }}
                                        </th>
                                        <th class="whitespace-nowrap">
                                            {{
                                                t(
                                                    "validation.attributes.status"
                                                )
                                            }}
                                        </th>
                                        <th class="whitespace-nowrap">
                                            {{
                                                t(
                                                    "validation.attributes.start_date"
                                                )
                                            }}
                                        </th>
                                        <th
                                            class="text-center whitespace-nowrap"
                                        >
                                            {{ t("admin.actions") }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        v-for="(event, fakerKey) in props.events
                                            .data"
                                        :key="fakerKey"
                                        class="intro-x"
                                    >
                                        <td>
                                            {{
                                                fakerKey +
                                                1 +
                                                15 *
                                                    (props.events.current_page -
                                                        1)
                                            }}
                                        </td>
                                        <td>
                                            {{ event.title }}
                                        </td>
                                        <td>
                                            {{ event.address }}
                                        </td>
                                        <td>{{ event.formatted_status }}</td>
                                        <td>{{ event.start_date }}</td>
                                        <td class="table-report__action w-56">
                                            <div
                                                class="flex justify-center items-center"
                                            >
                                                <Link
                                                    class="flex items-center mr-3"
                                                    :href="
                                                        route(
                                                            'dashboard.media.index',
                                                            {
                                                                event: event.uuid,
                                                            }
                                                        )
                                                    "
                                                >
                                                    <ImageIcon
                                                        class="w-4 h-4 mr-1"
                                                    />
                                                    {{
                                                        t(
                                                            "validation.attributes.media"
                                                        )
                                                    }}
                                                </Link>
                                                <Link
                                                    class="flex items-center mr-3"
                                                    :href="
                                                        route(
                                                            'dashboard.event.edit',
                                                            {
                                                                event: event.uuid,
                                                            }
                                                        )
                                                    "
                                                >
                                                    <CheckSquareIcon
                                                        class="w-4 h-4 mr-1"
                                                    />
                                                    {{ t("admin.update") }}
                                                </Link>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
