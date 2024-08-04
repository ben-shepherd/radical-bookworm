import Api from 'api/Api';
import ErrorThrower from 'api/ErrorThrower';
import { enqueueSnackbar } from 'notistack';
import { Dispatch, SetStateAction, useEffect, useRef, useState } from 'react';
import { Book } from '../../types/books.t';

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

const useBookById = ({ id = null, autoload = false }: Props = {}): Response => {
    const snackbarTimer = useRef<ReturnType<typeof setTimeout> | null>(null)
    const [book, setBook] = useState<Book | null>(null);
    const [loading, setLoading] = useState<boolean>(false);

    const fetchBook = async ({ id = null }: SearchProps): Promise<Book | null> => {

        if (!id || loading) {
            setBook(null)
            return null
        }

        setLoading(true);

        const response = ErrorThrower(
            await Api<Book>(`/books/${id}`, {
                method: 'GET',
            }),
            {
                showError: false
            }
        )

        setLoading(false);

        if (!response.ok) {
            if (snackbarTimer.current) clearTimeout(snackbarTimer.current);

            snackbarTimer.current = setTimeout(() => {
                let message = response.json.message

                if (response.code === 404) {
                    message = 'Book not found!';
                }

                enqueueSnackbar({ message, variant: 'error' })
            }, 1500)
            return null;
        }

        if (response.ok) {
            setBook(response.json)
            return response.json
        }

        return null
    }

    useEffect(() => {
        if (autoload && book === null) {
            fetchBook({ id })
        }
        return () => {
            if (snackbarTimer.current) clearTimeout(snackbarTimer.current);
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