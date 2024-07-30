import React from 'react';
import { Book } from '../../types/books.t';

type Props = {
    item: Book;
    className?: string;
}

const GalleryItem = ({ item, className = '' }: Props) => {

    const handleClick = () => {
        window.open(item.link, '_blank');
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