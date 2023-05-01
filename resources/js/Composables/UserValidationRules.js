import {
    email,
    helpers,
    maxLength,
    minLength,
    required,
} from "@vuelidate/validators";
import { validateCountry } from "./PhoneValidation";
import { useI18n } from "vue-i18n";

export function validation() {
    const { t } = useI18n();
    return {
        first_name: {
            required: helpers.withMessage(
                t("validation.required", {
                    attribute: t("validation.attributes.first_name"),
                }),
                required
            ),
            minLength: helpers.withMessage(
                t("validation.min.string", {
                    attribute: t("validation.attributes.first_name"),
                    min: 3,
                }),
                minLength(3)
            ),
            maxLength: helpers.withMessage(
                t("validation.max.string", {
                    attribute: t("validation.attributes.first_name"),
                    max: 120,
                }),
                maxLength(120)
            ),
        },
        middle_name: {
            required: helpers.withMessage(
                t("validation.required", {
                    attribute: t("validation.attributes.middle_name"),
                }),
                required
            ),
            minLength: helpers.withMessage(
                t("validation.min.string", {
                    attribute: t("validation.attributes.middle_name"),
                    min: 3,
                }),
                minLength(3)
            ),
            maxLength: helpers.withMessage(
                t("validation.max.string", {
                    attribute: t("validation.attributes.middle_name"),
                    max: 120,
                }),
                maxLength(120)
            ),
        },
        last_name: {
            required: helpers.withMessage(
                t("validation.required", {
                    attribute: t("validation.attributes.last_name"),
                }),
                required
            ),
            minLength: helpers.withMessage(
                t("validation.min.string", {
                    attribute: t("validation.attributes.last_name"),
                    min: 3,
                }),
                minLength(3)
            ),
            maxLength: helpers.withMessage(
                t("validation.max.string", {
                    attribute: t("validation.attributes.last_name"),
                    max: 120,
                }),
                maxLength(120)
            ),
        },
        email: {
            required: helpers.withMessage(
                t("validation.required", {
                    attribute: t("validation.attributes.email"),
                }),
                required
            ),
            email: helpers.withMessage(
                t("validation.email", {
                    attribute: t("validation.attributes.email"),
                }),
                email
            ),
        },
        phone: {
            required: helpers.withMessage(
                t("validation.required", {
                    attribute: t("validation.attributes.phone"),
                }),
                required
            ),
            validateCountry: helpers.withMessage(
                t("validation.regex", {
                    attribute: t("validation.attributes.phone"),
                }),
                validateCountry
            ),
        },
        country: {
            required: helpers.withMessage(
                t("validation.required", {
                    attribute: t("validation.attributes.country"),
                }),
                required
            ),
        },

        nationality: {
            required: helpers.withMessage(
                t("validation.required", {
                    attribute: t("validation.attributes.nationality"),
                }),
                required
            ),
        },
        gender: {
            required: helpers.withMessage(
                t("validation.required", {
                    attribute: t("validation.attributes.gender"),
                }),
                required
            ),
        },
    };
}
