import BookOpen from 'components/icons/BookOpen';
import Heart from 'components/icons/Heart';
import { Book } from 'types/books.t';
import StarRating from '../StarRating';

type Props = {
    book: Book;
    className?: string;
    onClick?: (...args: any[]) => any;
}

const ListItem = ({ book, className = '', onClick }: Props) => {

    const titleMaxLength = 26;
    const title = book.title.length > titleMaxLength ? book.title.slice(0, titleMaxLength) + '...' : book.title
    const { authors } = book


    const handleClick = () => {
        if(onClick) onClick(book);
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
                <StarRating rating={4.5} onClick={(value: number) => null} />
            </div>
            <div className="price">
                8 GBP
            </div>
            <div className="favouriteIcon">
                <Heart />
            </div>
        </div>
    )
}

export default ListItem