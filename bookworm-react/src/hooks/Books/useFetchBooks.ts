import React, { Dispatch, SetStateAction, useEffect, useState } from 'react';
import { Book } from '../../types/books.t';
import fakerBooks from '../../faker/fakerBooks';

type Props = {
    search?: string;
}
type Response = {
    books: Book[]
    setBooks: Dispatch<SetStateAction<Book[]>>;
    refresh: () => Promise<void>;
}

const useFetchBooks = ({ search = '' }: Props): Response => {
    const [books, setBooks] = useState<Book[]>([]);

    const fetchBooks = async () => {
        /**
         * TODO: replace with actual API endpoint
         */
        setBooks(fakerBooks())
    }

    useEffect(() => {
        setBooks([])
        fetchBooks()
    }, [search])

    return {
        books,
        setBooks,
        refresh: fetchBooks
    }
}

export default useFetchBooks