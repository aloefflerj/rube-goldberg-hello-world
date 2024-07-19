export const useLocalStorage = (
    keyName: string,
) => ({
    getValue: () => window.localStorage.getItem(keyName),
    setValue: (value: any) => window.localStorage.setItem(keyName, JSON.stringify(value))
});
