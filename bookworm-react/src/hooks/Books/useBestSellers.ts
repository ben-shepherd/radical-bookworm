import Api from 'api/Api';
import ErrorThrower from 'api/ErrorThrower';
import { Dispatch, SetStateAction, useState } from 'react';
import { Book } from '../../types/books.t';

type SearchProps = {
    search?: string;
    pageSize?: number;
    resultsEmptyWhenSearchEmpty?: boolean;
}
type Response = {
    books: Book[]
    setBooks: Dispatch<SetStateAction<Book[]>>;
    refresh: (props?: SearchProps) => Promise<void>;
    loading: boolean;
}

const useBestSellers = (): Response => {
    const [books, setBooks] = useState<Book[]>([]);
    const [loading, setLoading] = useState<boolean>(false);

    const fetchBooks = async ({ search = '', pageSize = 10, resultsEmptyWhenSearchEmpty = false }: SearchProps = {}) => {

        if ((search ?? '').length === 0 && resultsEmptyWhenSearchEmpty) {
            setBooks([])
            return;
        }

        setLoading(true);

        let url = 'best-sellers';

        if (search.length) {
            url = 'best-sellers-search?' + new URLSearchParams({
                search,
                pageSize: pageSize.toString()
            }).toString()
        }

        const response = ErrorThrower(
            await Api<Book[]>(url, {
                method: 'GET',
            })
        )

        if (response.ok) {
            setBooks(response.json)
        }

        setLoading(false);
    }

    return {
        books,
        setBooks,
        refresh: fetchBooks,
        loading
    }
}

export default useBestSellers