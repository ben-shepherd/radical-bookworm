import Api from 'api/Api';
import ErrorThrower from 'api/ErrorThrower';
import {Dispatch, SetStateAction, useEffect, useState} from 'react';
import {Book} from '../../types/books.t';

type Props = {
    id?: string | null;
    autoload?: boolean;
}
type SearchProps = {
    id?: string | null;
}
type Response = {
    book: Book | null;
    setBook: Dispatch<SetStateAction<Book | null>>;
    refresh: (props: SearchProps) => Promise<Book | null>;
    loading: boolean;
}

const useBookById = ({id = null, autoload = false}: Props = {}): Response => {
    const [book, setBook] = useState<Book | null>(null);
    const [loading, setLoading] = useState<boolean>(false);

    const fetchBook = async ({id = null}: SearchProps): Promise<Book | null> => {

        if (!id) {
            setBook(null)
            return null
        }

        setLoading(true);

        const response = ErrorThrower(
            await Api<Book>(`/books/${id}`, {
                method: 'GET',
            })
        )

        setLoading(false);

        if (response.ok) {
            setBook(response.json)
            return response.json
        }

        return null
    }

    useEffect(() => {
        if (autoload) {
            fetchBook({id})
        }
    }, [autoload])

    return {
        book,
        setBook,
        refresh: fetchBook,
        loading
    }
}

export default useBookById