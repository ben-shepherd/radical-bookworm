import Api from 'api/Api';
import ErrorThrower from 'api/ErrorThrower';
import {Dispatch, SetStateAction, useEffect, useState} from 'react';
import {Book} from '../../types/books.t';


type Response = {
    books: Book[]
    setBooks: Dispatch<SetStateAction<Book[]>>;
    refresh: () => Promise<void>;
    loading: boolean;
}

const useFavouriteBooks = (): Response => {
    const [books, setBooks] = useState<Book[]>([]);
    const [loading, setLoading] = useState<boolean>(false);

    const fetchFavouriteBooks = async () => {

        setLoading(true)

        const response = ErrorThrower(
            await Api<Book[]>('/books-favourites', {
                method: 'GET',
            })
        )

        if (response.ok) {
            setBooks(response.json)
        }

        setLoading(false)
    }

    useEffect(() => {
        setBooks([])
        fetchFavouriteBooks()
    }, [])

    return {
        books,
        setBooks,
        refresh: fetchFavouriteBooks,
        loading
    }
}

export default useFavouriteBooks