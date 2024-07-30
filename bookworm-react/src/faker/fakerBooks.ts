import { Book } from "../types/books.t";

const fakerBooks = (amount: number = 12, offset: number = 0): Book[] => {
    let books = [];

    const generateRandomString = () => Math.random().toString(36).substring(2, 15).toString();

    books.push({
        id: generateRandomString(),
        title: `Billy Summers`,
        authors: ['Stephen King'],
        description: `This is the description for book ${1}.`,
        image: `https://picsum.photos/536/354.jpg?v=${1}`,
        link: `https://example.com/book${1}`
    })

    for (let i = 1; i < amount; i++) {
        books.push({
            id: generateRandomString(),
            title: `Book Title ${offset + i + 1}`,
            authors: [`Author ${offset + i + 1}`, `Author ${offset + i + 2}`],
            description: `This is the description for book ${offset + i + 1}.`,
            image: `https://picsum.photos/536/354.jpg?v=${offset + i + 1}`,
            link: `https://example.com/book${offset + i + 1}`
        })
    }

    return books
}

export default fakerBooks;