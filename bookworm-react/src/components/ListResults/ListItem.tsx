import BookOpen from 'components/icons/BookOpen';
import Heart from 'components/icons/Heart';
import {Book} from 'types/books.t';
import StarRating from '../StarRating';
import useUpdateBook from "../../hooks/Books/useUpdateBook";
import {enqueueSnackbar} from "notistack";
import {useEffect, useState} from "react";
import HeartSolid from "../icons/HeartSolid";
import useUpdateFavouriteBook from "../../hooks/Books/useUpdateFavouriteBook";

type Props = {
    book: Book;
    favouriteBooks: Book[];
    className?: string;
    onClick?: (...args: any[]) => any;
    onRefresh?: (...args: any[]) => any;
}

const ListItem = ({book, favouriteBooks, className = '', onClick, onRefresh}: Props) => {

    const isBookFavourite = () => favouriteBooks.some((favouriteBook) => favouriteBook._id === book._id)
    const [isFavourite, setIsFavourite] = useState<boolean>(isBookFavourite())

    useEffect(() => {
        setIsFavourite(isBookFavourite())
    }, [book]);

    const {updateBook, updating} = useUpdateBook()
    const {updateFavouriteBook} = useUpdateFavouriteBook()

    const [rating, setRating] = useState<number>(book?.rating ?? 0)

    useEffect(() => {
        setRating(book?.rating ?? 0)
    }, [book]);

    const titleMaxLength = 26;
    const title = book.title.length > titleMaxLength ? book.title.slice(0, titleMaxLength) + '...' : book.title
    const {authors} = book

    const handleClick = () => {
        if (onClick) onClick(book);
    }

    const handleChangeRating = async (value: number) => {
        if (updating) {
            return;
        }

        setRating(value)

        const response = await updateBook(book._id, {
            rating: value
        })

        if (response.ok) {
            enqueueSnackbar({message: 'Rating has been updated!', variant: 'success'})

            if (typeof onRefresh === 'function') {
                onRefresh();
            }
        }
    }

    const handleClickUpdateFavourite = async () => {
        if (!book._id) {
            return;
        }

        setIsFavourite(!isFavourite)
        const response = await updateFavouriteBook(book._id)

        if (response.ok) {
            if (typeof onRefresh === 'function') {
                onRefresh()
            }

            const message = response.json.type ? 'Book has been favourited!' : 'Book has been removed from favourites!'
            const variant = response.json.type ? 'success' : 'warning'
            enqueueSnackbar({message, variant})
            setIsFavourite(response.json.type)
        }
    }

    return (
        <div className={`ListItem ${className}`}>
            <div className="bookIcon w-9">
                <BookOpen/>
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
                <StarRating rating={rating} onClick={(value: number) => handleChangeRating(value)}/>
            </div>
            <div className="price">
                {book?.price ?? 0} GBP
            </div>
            <div className={`favouriteIcon ${isFavourite ? 'active' : ''}`}>
                <button onClick={handleClickUpdateFavourite}>
                    {isFavourite ? <HeartSolid/> : <Heart/>}
                </button>
            </div>
        </div>
    )
}

export default ListItem