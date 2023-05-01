import {
    helpers,
    maxLength,
    maxValue,
    minLength,
    minValue,
    required,
} from "@vuelidate/validators";
import { useI18n } from "vue-i18n";

export function validations() {
    const { t } = useI18n();
    return {
        start_time: {
            required: helpers.withMessage(
                t("validation.required", {
                    attribute: t("validation.attributes.start_time"),
                }),
                required
            ),
        },
        event: {
            required: helpers.withMessage(
                t("validation.required", {
                    attribute: t("validation.attributes.event"),
                }),
                required
            ),
        },
        race: {
            required: helpers.withMessage(
                t("validation.required", {
                    attribute: t("validation.attributes.race"),
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
        age_group: {
            required: helpers.withMessage(
                t("validation.required", {
                    attribute: t("validation.attributes.age_group"),
                }),
                required
            ),
        },
        distance: {
            required: helpers.withMessage(
                t("validation.required", {
                    attribute: t("validation.attributes.distance"),
                }),
                required
            ),
            minValue: helpers.withMessage(
                t("validation.min.numeric", {
                    attribute: t("validation.attributes.amount"),
                    value: 1,
                }),
                minValue(1)
            ),
        },
        participants: {
            required: helpers.withMessage(
                t("validation.required", {
                    attribute: t("validation.attributes.participants"),
                }),
                required
            ),
            minValue: helpers.withMessage(
                t("validation.min.numeric", {
                    attribute: t("validation.attributes.amount"),
                    value: 1,
                }),
                minValue(1)
            ),
        },
        price: {
            required: helpers.withMessage(
                t("validation.required", {
                    attribute: t("validation.attributes.price"),
                }),
                required
            ),
            minValue: helpers.withMessage(
                t("validation.min.numeric", {
                    attribute: t("validation.attributes.amount"),
                    value: 1,
                }),
                minValue(1)
            ),
            maxValue: helpers.withMessage(
                t("validation.max.numeric", {
                    attribute: t("validation.attributes.amount"),
                    value: 100000,
                }),
                maxValue(100000)
            ),
        },
    };
}
