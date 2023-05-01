import { helpers, maxLength, minLength, required } from "@vuelidate/validators";
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
                    max: 50,
                }),
                maxLength(50)
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
                    max: 50,
                }),
                maxLength(50)
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
                    max: 50,
                }),
                maxLength(50)
            ),
        },
        date_of_birth: {
            required: helpers.withMessage(
                t("validation.required", {
                    attribute: t("validation.attributes.date_of_birth"),
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
