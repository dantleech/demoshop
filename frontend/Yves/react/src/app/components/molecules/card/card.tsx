
import * as React from 'react';

export interface ICardProps {
    title: string,
    description: string,
    price: string,
    imageUrl: string,
    url: string
}

export class Card extends React.Component<ICardProps, undefined> {
    render() {
        return <h1 className="a-test"></h1>;
    }
}

