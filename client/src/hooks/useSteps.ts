import type { AxiosResponse } from 'axios';
import { get } from '../ApiRequest';
import type Step from '../types/Step';
import type Speech from '../types/Speech';

const routeBaseUrl = '/steps';

export const useSteps = (callFromServer = false) => ({
    fetchSteps: (
        debug: boolean = false
    ): Promise<AxiosResponse<{ steps: Step[] }, any>> => get(
        routeBaseUrl,
        debug,
        callFromServer
    ),

    fetchSpeechesByStep: (
        stepId: string,
        debug: boolean = false
    ): Promise<AxiosResponse<{ speeches: Speech[] }, any>> => get(
        `${routeBaseUrl}/${stepId}/speeches`, debug, callFromServer
    ),
});