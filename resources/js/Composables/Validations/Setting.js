import {
    helpers,
    maxLength,
    minLength,
    required,
    url,
} from "@vuelidate/validators";
import { useI18n } from "vue-i18n";

export function validations() {
    const { t } = useI18n();
    const versionRegex = (version) =>
        /^(0|[1-9]\d*)\.(0|[1-9]\d*)\.(0|[1-9]\d*)$/.test(version);
    const phoneRegex = (phone) =>
        /^(\+974)(5|4|3|6|3|7)([0-9]{7})$/.test(phone);
    return {
        phone: {
            required: helpers.withMessage(
                t("validation.required", {
                    attribute: t("validation.attributes.phone"),
                }),
                required
            ),
            regex: helpers.withMessage(
                t("validation.regex", {
                    attribute: t("validation.attributes.phone"),
                }),
                phoneRegex
            ),
        },
        whatsapp: {
            required: helpers.withMessage(
                t("validation.required", {
                    attribute: t("validation.attributes.whatsapp"),
                }),
                required
            ),
            regex: helpers.withMessage(
                t("validation.regex", {
                    attribute: t("validation.attributes.whatsapp"),
                }),
                phoneRegex
            ),
        },
        facebook: {
            required: helpers.withMessage(
                t("validation.required", {
                    attribute: t("validation.attributes.facebook"),
                }),
                required
            ),
            url: helpers.withMessage(
                t("validation.required", {
                    attribute: t("validation.attributes.facebook"),
                }),
                url
            ),
        },
        instagram: {
            required: helpers.withMessage(
                t("validation.required", {
                    attribute: t("validation.attributes.instagram"),
                }),
                required
            ),
            url: helpers.withMessage(
                t("validation.required", {
                    attribute: t("validation.attributes.facebook"),
                }),
                url
            ),
        },
        twitter: {
            required: helpers.withMessage(
                t("validation.required", {
                    attribute: t("validation.attributes.twitter"),
                }),
                required
            ),
            url: helpers.withMessage(
                t("validation.required", {
                    attribute: t("validation.attributes.twitter"),
                }),
                url
            ),
        },
        snapchat: {
            required: helpers.withMessage(
                t("validation.required", {
                    attribute: t("validation.attributes.snapchat"),
                }),
                required
            ),
            url: helpers.withMessage(
                t("validation.required", {
                    attribute: t("validation.attributes.snapchat"),
                }),
                url
            ),
        },
        youtube: {
            required: helpers.withMessage(
                t("validation.required", {
                    attribute: t("validation.attributes.youtube"),
                }),
                required
            ),
            url: helpers.withMessage(
                t("validation.required", {
                    attribute: t("validation.attributes.youtube"),
                }),
                url
            ),
        },
        // version: {
        //     required: helpers.withMessage(
        //         t("validation.required", {
        //             attribute: t("validation.attributes.version"),
        //         }),
        //         required
        //     ),
        //     regex: helpers.withMessage(
        //         t("validation.regex", {
        //             attribute: t("validation.attributes.version"),
        //         }),
        //         versionRegex
        //     ),
        // },
    };
}
