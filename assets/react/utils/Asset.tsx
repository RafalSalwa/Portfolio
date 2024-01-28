export function getAsset(path: string, deliveryServer: string = 'cdn') {
    if (process.env.NODE_ENV === 'production') {
        return 'https://cdn.salwa.com.pl/' + path;
    }
    return "https://cdn.salwa.com.pl/" + path;
}
