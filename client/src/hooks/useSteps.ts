import { get } from '../ApiRequest';

const routeBaseUrl = '/steps';

export const useSteps = (callFromServer = false) => ({
    fetchSteps: (debug: boolean = false) => get(routeBaseUrl, debug, callFromServer),
});