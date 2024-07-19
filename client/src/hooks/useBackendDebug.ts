import type BackentDebug from "../types/BackentDebug";
import { useLocalStorage } from "./useLocalStorage";

const storageKey = 'backendDebug';

export const useBackendDebug = () => {
    const { getValue, setValue } = useLocalStorage(storageKey);

    return ({
        getDebugInfo: (): BackentDebug => JSON.parse(getValue() ?? ''),
        setDebugInfo: (value: BackentDebug): void => setValue(value),
    });
};
