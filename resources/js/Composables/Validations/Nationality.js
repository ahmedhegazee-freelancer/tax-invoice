import { useI18n } from "vue-i18n";

import { nameValidationRules } from "./NameValidation";

export function validations() {
    const { t } = useI18n(); // use as global scope

    return {
        ...nameValidationRules(),
    };
}
