import Api, { ApiResponse } from 'api/Api';
import ErrorThrower from 'api/ErrorThrower';
import { useAppDispatch, useAppSelector } from 'hooks/redux';
import { useState } from 'react';
import { selectFavourites, setFavourites } from 'reducers/booksReducer';
import { Book } from '../../types/books.t';


type Response = {
    books: Book[]
    setBooks: (books: Book[]) => void;
    refresh: () => Promise<ApiResponse<Book[]>>;
    loading: boolean;
}

const useFavouriteBooks = (): Response => {
    const books = useAppSelector(state => selectFavourites(state.books))
    const dispatch = useAppDispatch()

    const [loading, setLoading] = useState<boolean>(false);

    const setBooks = (books: Book[]) => {
        dispatch(setFavourites(books))
    }

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

        return response
    }

    return {
        books,
        setBooks,
        refresh: fetchFavouriteBooks,
        loading
    }
}

export default useFavouriteBooks