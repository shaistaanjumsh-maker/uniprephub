import { createI18n } from "vue-i18n";
import axios from "axios";

const defaultLang = "en";
const storedLang = localStorage.getItem("lang") || defaultLang;
const locale = storedLang.split("-")[0];
const i18n = createI18n({
    locale,
    fallbackLocale: defaultLang,
    messages: {},
});
function fetchLocalizationData() {
    const lang = localStorage.getItem("lang") || defaultLang;
    const currentLocale = lang.split("-")[0];

    axios.get("/lang/" + currentLocale)
        .then((response) => {
            i18n.global.setLocaleMessage(currentLocale, response.data);
            i18n.global.locale = currentLocale;
        })
        .catch((error) => {
            console.error("Failed to load language file", error);
            if (currentLocale !== defaultLang) {
                axios.get("/lang/" + defaultLang)
                    .then((response) => {
                        i18n.global.setLocaleMessage(defaultLang, response.data);
                        i18n.global.locale = defaultLang;
                    })
                    .catch((fallbackError) => {
                        console.error("Failed to load fallback language file", fallbackError);
                    });
            }
        });
}

export default { i18n, fetchLocalizationData };
