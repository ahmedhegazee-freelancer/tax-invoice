import {
    helpers,
    maxLength,
    minLength,
    minValue,
    required,
} from "@vuelidate/validators";
import { useI18n } from "vue-i18n";

export function validations() {
    const { t } = useI18n();
    return {
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
        result_file: {
            required: helpers.withMessage(
                t("validation.required", {
                    attribute: t("validation.attributes.result_file"),
                }),
                required
            ),
        },
    };
}
