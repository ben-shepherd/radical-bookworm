import Api from 'api/Api';
import ErrorThrower from 'api/ErrorThrower';
import {Dispatch, SetStateAction, useEffect, useState} from 'react';
import {Book} from '../../types/books.t';

type Props = {
    autoload?: boolean;
}
type SearchProps = {
    search?: string;
    resultsEmptyWhenSearchEmpty?: boolean;
    waitMs?: number | null;
    pageSize?: number;
}
type Response = {
    books: Book[]
    setBooks: Dispatch<SetStateAction<Book[]>>;
    refresh: (props: SearchProps) => Promise<Book[] | null>;
    loading: boolean;
}

const useFetchBooks = ({autoload = false}: Props = {}): Response => {
    const [books, setBooks] = useState<Book[]>([]);
    const [loading, setLoading] = useState<boolean>(false);

    const fetchBooks = async ({
                                  search = '',
                                  resultsEmptyWhenSearchEmpty,
                                  pageSize = 10
                              }: SearchProps = {}): Promise<Book[] | null> => {

        if ((search ?? '').length === 0 && resultsEmptyWhenSearchEmpty) {
            setBooks([])
            return null;
        }

        setLoading(true);

        const response = ErrorThrower(
            await Api<Book[]>('/books?' + new URLSearchParams({
                search,
                pageSize: pageSize?.toString()
            }).toString(), {
                method: 'GET',
            })
        )

        setLoading(false);

        if (response.ok) {
            setBooks(response.json)
            return response.json
        }

        return []
    }

    useEffect(() => {
        if (autoload) {
            fetchBooks()
        }
    }, [autoload])

    return {
        books,
        setBooks,
        refresh: fetchBooks,
        loading
    }
}

export default useFetchBooks