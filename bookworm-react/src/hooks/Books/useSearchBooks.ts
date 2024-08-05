import Api, { ApiResponse } from 'api/Api';
import ErrorThrower from 'api/ErrorThrower';
import { useAppDispatch, useAppSelector } from 'hooks/redux';
import { useState } from 'react';
import { selectSearchResults, setSearchResults } from 'reducers/booksReducer';
import { Book } from '../../types/books.t';

type SearchProps = {
    search?: string;
    pageSize?: number;
    resultsEmptyWhenSearchEmpty?: boolean;
}
type Response = {
    books: Book[]
    setBooks: (books: Book[]) => void;
    refresh: (props?: SearchProps) => Promise<ApiResponse<Book[]>>;
    loading: boolean;
}

const useBestSellerSearchResults = (): Response => {
    const books = useAppSelector(state => selectSearchResults(state.books))
    const dispatch = useAppDispatch()

    const [loading, setLoading] = useState<boolean>(false);

    const setBooks = (books: Book[]) => {
        dispatch(setSearchResults(books))
    }

    const fetchBooks = async ({ search = '', pageSize = 10, resultsEmptyWhenSearchEmpty = false }: SearchProps = {}) => {

        if ((search ?? '').length === 0 && resultsEmptyWhenSearchEmpty) {
            setBooks([])
            return {
                code: 200,
                ok: true,
                json: []
            } as ApiResponse<Book[]>;
        }

        setLoading(true);


        const response = ErrorThrower(
            await Api<Book[]>('best-sellers-search?' + new URLSearchParams({
                search,
                pageSize: pageSize.toString()
            }).toString(), {
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

export default useBestSellerSearchResults