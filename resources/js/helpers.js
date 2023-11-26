
export function strSlug(string) {
    return string
        .normalize("NFD") // Normaliza los caracteres y descompone los acentos
        .replace(/[\u0300-\u036f]/g, "") // Elimina los caracteres diacríticos (acentos)
        .replace(/&&+/g, "&")
        .replace(/&+/g, "and")
        .replace(/\s+/g, "-")
        .replace(/[^\w\-]+/g, "")
        .replace(/--+/g, "-")
        .toLowerCase()
        .trim();
}