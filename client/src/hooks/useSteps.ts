import type { AxiosResponse } from 'axios';
import { get, post, put } from '../ApiRequest';
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

    nextStep: (debug: boolean = false): Promise<AxiosResponse<{ step: Step }, any>> => post(
        `${routeBaseUrl}/next`, debug, callFromServer
    ),

    resetSteps: (debug: boolean = false): Promise<AxiosResponse<{ step: Step }, any>> => put(
        `${routeBaseUrl}/reset`, debug, callFromServer
    )
});