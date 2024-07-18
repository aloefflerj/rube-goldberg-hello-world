import { get } from '../ApiRequest';

const routeBaseUrl = '/steps';

export const useSteps = (callFromServer = false) => ({
    fetchSteps: (debug: boolean = false) => get(routeBaseUrl, debug, callFromServer),
    fetchSpeechesByStep: (stepId: string, debug: boolean = false) => get(`${routeBaseUrl}/${stepId}/speeches`, debug, callFromServer),
});