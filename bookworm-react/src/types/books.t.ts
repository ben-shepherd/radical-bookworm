export interface Book {
    id: number;
    externalId?: string;
    title: string;
    authors: string[];
    description: string;
    image: string;
    link: string;
    price?: number;
    rating?: number;
}