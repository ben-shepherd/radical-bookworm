import Api from 'api/Api';
import ErrorThrower from 'api/ErrorThrower';
import { Dispatch, SetStateAction, useEffect, useState } from 'react';
import { Book } from '../../types/books.t';

type Props = {
    autoload?: boolean;
}
type SearchProps = {
    search?: string;
    resultsEmptyWhenSearchEmpty?: boolean;
    waitMs?: number | null;
}
type Response = {
    books: Book[]
    setBooks: Dispatch<SetStateAction<Book[]>>;
    refresh: (props: SearchProps) => Promise<void>;
    loading: boolean;
}

const useFetchBooks = ({ autoload = false }: Props = {}): Response => {
    const [books, setBooks] = useState<Book[]>([]);
    const [loading, setLoading] = useState<boolean>(false);
  
    const fetchBooks = async ({ search = '', resultsEmptyWhenSearchEmpty }: SearchProps = {}) => {

        if((search ?? '').length === 0 && resultsEmptyWhenSearchEmpty) {
            setBooks([])
            return;
        }

        setLoading(true);

        const response = ErrorThrower(
            await Api<Book[]>('books/v1/books?' + new URLSearchParams({ search }).toString(), {
                method: 'GET',
            })
        )

        if (response.ok) {
            setBooks(response.json)
        }

        setLoading(false);
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