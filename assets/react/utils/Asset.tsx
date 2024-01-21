export function getAsset(path: string) {
    if (process.env.NODE_ENV === 'production') {
        return 'https://apps.salwa.com.pl/build/img/' + path;
    }
    return "http://localhost:8080/build/img/" + path;
}
