export interface Book {
    _id: string;
    title: string;
    authors: string[];
    description: string;
    image: string;
    link: string;
    price?: number;
    rating?: number;
}