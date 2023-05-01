import {
    required,
    minLength,
    maxLength,
    helpers,
    numeric,
    minValue,
    maxValue,
} from "@vuelidate/validators";
import { useI18n } from "vue-i18n";
import { nameValidationRules } from "./NameValidation";

export function validations() {
    const { t } = useI18n(); // use as global scope
    const lessThan = (value, siblings) => value < siblings.to;
    const greatThan = (value, siblings) => value > siblings.from;

    return {
        ...nameValidationRules(),
        from: {
            required: helpers.withMessage(
                t("validation.required", { attribute: "from" }),
                required
            ),
            numeric: helpers.withMessage(t("validation.numeric"), numeric),
            lessThan: helpers.withMessage(
                t("validation.lt.numeric", {
                    attribute: t("validation.attributes.from"),
                    value: "",
                }),
                lessThan
            ),
            minValue: helpers.withMessage(
                t("validation.min.numeric", {
                    attribute: t("validation.attributes.from"),
                    value: 12,
                }),
                minValue(12)
            ),
            maxValue: helpers.withMessage(
                t("validation.max.numeric", {
                    attribute: t("validation.attributes.from"),
                    value: 110,
                }),
                maxValue(110)
            ),
        },
        to: {
            required: helpers.withMessage(
                t("validation.required", { attribute: "to" }),
                required
            ),
            numeric: helpers.withMessage(t("validation.numeric"), numeric),
            greatThan: helpers.withMessage(
                t("validation.gt.numeric", {
                    attribute: t("validation.attributes.to"),
                    value: "",
                }),
                greatThan
            ),
            minValue: helpers.withMessage(
                t("validation.min.numeric", {
                    attribute: t("validation.attributes.to"),
                    value: 13,
                }),
                minValue(13)
            ),
            maxValue: helpers.withMessage(
                t("validation.max.numeric", {
                    attribute: t("validation.attributes.to"),
                    value: 120,
                }),
                maxValue(110)
            ),
        },
    };
}
