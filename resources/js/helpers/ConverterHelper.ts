export function convertDateTimeIndo(dateValue: string | undefined) {

    if (dateValue) {
        const date = new Date(dateValue);
        const formatted = new Intl.DateTimeFormat('id-ID', {
            year: 'numeric',
            month: 'long',
            day: 'numeric',
            hour: 'numeric',
            minute: '2-digit',
            second: '2-digit',
            hour12: false
        }).format(date);

        return formatted.replace('pukul ', ' - ').replace('.', ':');
    } else {
        return '';
    }
}


export function capitalizeEachWord(sentence: string) {
    if (typeof sentence !== 'string' || sentence.length === 0) {
        return sentence; // Handle empty or non-string inputs
    }
    sentence = sentence.replace('_', ' ');
    const words = sentence.split(' ');
    const capitalizedWords = words.map(word => {
        if (word.length === 0) {
        return '';
        }
        return word.charAt(0).toUpperCase() + word.slice(1);
    });
    return capitalizedWords.join(' ');
}
