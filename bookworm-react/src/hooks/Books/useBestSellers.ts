import Api, { ApiResponse } from 'api/Api';
import ErrorThrower from 'api/ErrorThrower';
import { useAppDispatch, useAppSelector } from 'hooks/redux';
import { useState } from 'react';
import { selectBestSellers, setBestSellers } from 'reducers/booksReducer';
import { Book } from '../../types/books.t';

type Response = {
    books: Book[]
    setBooks: (books: Book[]) => void;
    refresh: () => Promise<ApiResponse<Book[]>>;
    loading: boolean;
}



const useBestSellers = (): Response => {
    const books = useAppSelector(state => selectBestSellers(state.books))
    const dispatch = useAppDispatch()

    const [loading, setLoading] = useState<boolean>(false);

    const setBooks = (books: Book[]) => {
        dispatch(setBestSellers(books))
    }

    const fetchBooks = async () => {

        setLoading(true);

        const response = ErrorThrower(
            await Api<Book[]>('best-sellers', {
                method: 'GET',
            })
        )

        if (response.ok) {
            setBooks(response.json)
        }

        setLoading(false);
        return response
    }

    return {
        books,
        setBooks,
        refresh: fetchBooks,
        loading
    }
}

export default useBestSellers