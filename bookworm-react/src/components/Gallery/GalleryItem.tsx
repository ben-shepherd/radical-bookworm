import { Book } from '../../types/books.t';

type Props = {
    item: Book;
    className?: string;
    onClick?: (book: Book) => any;
}

const GalleryItem = ({ item, className = '', onClick }: Props) => {

    const handleClick = () => {
        if(typeof onClick === 'function') {
            onClick(item);
        }
    }

    return (
        <div className={`GalleryItem ${className}`} title={item.title}>
            <button className='GalleryItemButton' onClick={handleClick}>
                <div className='image' style={{ backgroundImage: `url(${item.image})` }}></div>
            </button>
        </div>
    )
}

export default GalleryItem;