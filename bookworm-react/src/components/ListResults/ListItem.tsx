import BookOpen from 'components/icons/BookOpen';
import Heart from 'components/icons/Heart';
import useCreateBook from 'hooks/Books/useCreateBook';
import { useAppDispatch } from 'hooks/redux';
import { enqueueSnackbar } from "notistack";
import { useEffect, useState } from "react";
import { setFavourites } from 'reducers/booksReducer';
import { Book } from 'types/books.t';
import useUpdateBook from "../../hooks/Books/useUpdateBook";
import useUpdateFavouriteBook from "../../hooks/Books/useUpdateFavouriteBook";
import HeartSolid from "../icons/HeartSolid";
import StarRating from '../StarRating';

export type ListItemProps = {
    book: Book;
    favouriteBooks: Book[];
    className?: string;
}
export type ListItemEventProps = {
    onClick?: (...args: any[]) => any;
    onRefresh?: (...args: any[]) => any;
    onEdit?: (...args: any[]) => any;
    onDelete?: (...args: any[]) => any;
}

const ListItem = ({ book, favouriteBooks, className = '', onClick, onRefresh, onEdit, onDelete }: ListItemProps & ListItemEventProps) => {

    const dispatch = useAppDispatch();

    const isFavourite = favouriteBooks.some((favouriteBook) => {
        const idMatch = favouriteBook.id === book.id
        const idExternalMatch = favouriteBook.externalId && favouriteBook.externalId === book.externalId
        return idMatch || idExternalMatch
    })

    const { createBook } = useCreateBook()
    const { updateBook, updating } = useUpdateBook()
    const { updateFavouriteBook } = useUpdateFavouriteBook()

    const [rating, setRating] = useState<number>(book?.rating ?? 0)

    useEffect(() => {
        setRating(book?.rating ?? 0)
    }, [book]);

    const titleMaxLength = 26;
    const title = book.title.length > titleMaxLength ? book.title.slice(0, titleMaxLength) + '...' : book.title
    const { authors } = book

    const [confirmDelete, setConfirmDelete] = useState<boolean>(false)

    const editable = typeof onEdit === 'function'
    const deletable = typeof onDelete === 'function'

    const handleClick = () => {
        if (onClick) onClick(book);
    }

    const handleChangeRating = async (value: number) => {
        if (updating) {
            return;
        }

        setRating(value)

        const createResponse = await createBook(book)

        if (!createResponse.ok) {
            return;
        }

        const response = await updateBook(createResponse.json.id, {
            rating: value
        })

        if (response.ok) {
            enqueueSnackbar({ message: 'Rating has been updated!', variant: 'success' })

            if (typeof onRefresh === 'function') {
                onRefresh();
            }
        }
    }

    const handleDelete = async () => {
        if (deletable && confirmDelete) {
            onDelete(book)
            return;
        }

        setConfirmDelete(true)
    }

    const handleClickUpdateFavourite = async () => {

        const createResponse = await createBook(book);

        if (!createResponse.ok) {
            return;
        }

        const response = await updateFavouriteBook(createResponse.json.id)

        if (response.ok) {
            if (typeof onRefresh === 'function') {
                onRefresh()
            }

            const message = response.json.type ? 'Book has been favourited!' : 'Book has been removed from favourites!'
            const variant = response.json.type ? 'success' : 'warning'
            enqueueSnackbar({ message, variant })

            let newFavourites = [...favouriteBooks]

            if (response.json.type) {
                newFavourites.push(createResponse.json)
            }
            else {
                newFavourites = newFavourites.filter((favouriteBook) => favouriteBook.id !== createResponse.json.id)
            }

            dispatch(setFavourites(newFavourites))
        }
    }



    return (
        <div className={`ListItem ${className}`}>
            <div className="bookIcon w-9">
                <BookOpen />
            </div>
            <div className='summary'>
                <div className="title">
                    <button onClick={handleClick}>{title}</button>
                </div>
                <div className="author">
                    <p>by <span className="capitalize">{authors[0]}</span></p>
                </div>
            </div>
            <div className="ratings">
                <StarRating rating={rating} onClick={(value: number) => handleChangeRating(value)} />
            </div>
            <div className="price">
                {book?.price ?? 0} GBP
            </div>
            {editable && (
                <div className="action edit">
                    <button onClick={() => onEdit(book)}>Edit</button>
                </div>
            )}
            {deletable && (
                <div className="action delete">
                    <button onClick={handleDelete}>{confirmDelete ? 'Confirm?' : 'Delete'}</button>
                    {confirmDelete && <button className='cancel' onClick={() => setConfirmDelete(false)}>Cancel</button>}
                </div>
            )}
            <div className={`favouriteIcon ${isFavourite ? 'active' : ''}`}>
                <button onClick={handleClickUpdateFavourite}>
                    {isFavourite ? <HeartSolid /> : <Heart />}
                </button>
            </div>
        </div>
    )
}

export default ListItem