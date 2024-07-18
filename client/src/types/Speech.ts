export default interface Speech {
    id: string;
    stepId: string;
    order: number;
    content: string;
    speed: 'pause' | 'slow' | 'normal' | 'fast';
    highlight: boolean;
}