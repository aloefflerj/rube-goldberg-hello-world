import type Speech from "../types/Speech";

export function speechesByStep(stepId: string, speeches: Speech[]): Speech[] {
    return speeches.filter((speech) => {
        return speech.stepId === stepId;
    });
}